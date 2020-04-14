<?php
class creditPolicies{
	private function validatePolicyCredit_newCustomer($identificationNumber)
	{
		// 5	Puntaje y 3.4 Calificacion Score
		$customerStatusDenied = false;
		$idDef = "";
		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$customerScore = $this->cifinScoreInterface->getCustomerLastCifinScore($identificationNumber)->score;
		$data = ['CEDULA' => $identificationNumber];
		$customerIntention =  $this->intentionInterface->createIntention($data);

		if (empty($customer)) {
			return ['resp' => "false"];
		} else {
			if ($customerScore <= -8) {
				$customerStatusDenied = true;
				$idDef = '8';
				$perfilCrediticio = 'TIPO NE';
				return ['resp' => "false"];
			}

			if ($customerScore >= 1 && $customerScore <= 275) {
				$customerStatusDenied = true;
				$idDef = '5';
				$perfilCrediticio = 'TIPO D';
			}

			if ($customerScore >= -7 && $customerScore <= 0) {
				$perfilCrediticio = 'TIPO 5';
			}

			if ($customerScore >= 275 && $customerScore <= 527) {
				$perfilCrediticio = 'TIPO D';
			}

			if ($customerScore >= 528 && $customerScore <= 624) {
				$perfilCrediticio = 'TIPO C';
			}

			if ($customerScore >= 625 && $customerScore <= 674) {
				$perfilCrediticio = 'TIPO B';
			}

			if ($customerScore >= 675 && $customerScore <= 1000) {
				$perfilCrediticio = 'TIPO A';
			}

			$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;
			$customerIntention->save();
		}

		// 3.3 Estado de obligaciones
		$respValorMoraFinanciero = $this->CifinFinancialArrearsInterface->checkCustomerHasCifinFinancialArrear($identificationNumber)->sum('finvrmora');
		$respValorMoraReal       = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealArrear($identificationNumber)->sum('rmvrmora');
		$totalValorMora          = $respValorMoraFinanciero + $respValorMoraReal;

		if ($totalValorMora > 100) {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "6";
			}
			$customerIntention->ESTADO_OBLIGACIONES = 0;
			$customerIntention->save();
		} else {
			$customerIntention->ESTADO_OBLIGACIONES = 1;
			$customerIntention->save();
		}

		$customerRealDoubtful = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealDoubtful($identificationNumber);
		$customerFinDoubtful = $this->CifinFinancialArrearsInterface->checkCustomerHasCifinFinancialDoubtful($identificationNumber);
		if ($customerRealDoubtful->isNotEmpty()) {
			if ($customerRealDoubtful[0]->rmsaldob > 0) {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "6";
				}
				$customerIntention->ESTADO_OBLIGACIONES = 0;
				$customerIntention->save();
			}
		}

		if ($customerFinDoubtful->isNotEmpty()) {
			if ($customerFinDoubtful[0]->finsaldob > 0) {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "6";
				}
				$customerIntention->ESTADO_OBLIGACIONES = 0;
				$customerIntention->save();
			}
		}

		//3.5 Historial de Crédito
		$historialCrediticio = 0;
		$historialCrediticio = $this->UpToDateFinancialCifinInterface->check6MonthsPaymentVector($identificationNumber);

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->extintFinancialCifinInterface->check6MonthsPaymentVector($identificationNumber);
		}

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->UpToDateRealCifinInterface->check6MonthsPaymentVector($identificationNumber);
		}

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->extinctRealCifinInterface->check6MonthsPaymentVector($identificationNumber);
		}

		$customerIntention->HISTORIAL_CREDITO = $historialCrediticio;
		//4.1 Zona de riesgo
		$customerIntention->ZONA_RIESGO =  $this->subsidiaryInterface->getSubsidiaryRiskZone($customer->SUC)->ZONA;
		// 4.2 Tipo de cliente
		$tipoCliente = '';
		$queryGetClienteActivo = sprintf("SELECT COUNT(`CEDULA`) as tipoCliente
		FROM TB_CLIENTES_ACTIVOS
		WHERE `CEDULA` = %s AND FECHA >= date_add(NOW(), INTERVAL -24 MONTH)", $identificationNumber);

		$respClienteActivo = DB::connection('oportudata')->select($queryGetClienteActivo);
		if ($respClienteActivo[0]->tipoCliente == 1) {
			$tipoCliente = 'OPORTUNIDADES';
		} else {
			$tipoCliente = 'NUEVO';
		}

		$customerIntention->TIPO_CLIENTE = $tipoCliente;
		$customerIntention->save();

		// 4.3 Edad.
		$queryEdad = $this->cifinBasicDataInterface->checkCustomerHasCifinBasicData($identificationNumber)->teredad;
		if ($queryEdad == false || empty($queryEdad)) {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "9";
			}
			$customerIntention->EDAD = 0;
			$customerIntention->save();
		}

		if ($queryEdad == 'Mas 75') {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "9";
			}
			$customerIntention->EDAD = 0;
			$customerIntention->save();
		}

		$queryEdad = explode('-', $queryEdad);
		$edadMin = $queryEdad[0];
		$edadMax = $queryEdad[1];

		$validateTipoCliente = TRUE;
		if ($customer->ACTIVIDAD == 'PENSIONADO') {
			$validateTipoCliente = FALSE;
			if ($edadMin >= 18 && $edadMax <= 80) {
				$customerIntention->EDAD = 1;
				$customerIntention->save();
			} else {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "9";
				}
				$customerIntention->EDAD = 0;
				$customerIntention->save();
			}
		}

		if ($tipoCliente == 'OPORTUNIDADES' && $validateTipoCliente == TRUE) {
			if ($edadMin >= 18 && $edadMax <= 75) {
				$customerIntention->EDAD = 1;
				$customerIntention->save();
			} else {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "9";
				}
				$customerIntention->EDAD = 0;
				$customerIntention->save();
			}
		}

		if ($tipoCliente == 'NUEVO' && $validateTipoCliente == TRUE) {
			if ($edadMin >= 18 && $edadMax <= 70) {
				$customerIntention->EDAD = 1;
				$customerIntention->save();
			} else {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "9";
				}
				$customerIntention->EDAD = 0;
				$customerIntention->save();
			}
		}

		// 4.5 Tiempo en Labor
		if ($customer->ACTIVIDAD == 'PENSIONADO') {
			$customerIntention->TIEMPO_LABOR = 1;
			$customerIntention->save();
		} else {
			if ($customer->ACTIVIDAD == 'RENTISTA' || $customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($customer->EDAD_INDP >= 4) {
					$customerIntention->TIEMPO_LABOR = 1;
					$customerIntention->save();
				} else {
					if ($customerStatusDenied == false && empty($idDef)) {
						$customerStatusDenied = true;
						$idDef = "10";
					}
					$customerIntention->TIEMPO_LABOR = 0;
					$customerIntention->save();
				}
			} else {
				if ($customer->ANTIG >= 4) {
					$customerIntention->TIEMPO_LABOR = 1;
					$customerIntention->save();
				} else {
					if ($customerStatusDenied == false && empty($idDef)) {
						$customerStatusDenied = true;
						$idDef = "10";
					}
					$customerIntention->TIEMPO_LABOR = 0;
					$customerIntention->save();
				}
			}
		}

		// 4.7 Inspecciones Oculares
		if ($tipoCliente == 'NUEVO') {
			if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($perfilCrediticio == 'TIPO C' || $perfilCrediticio == 'TIPO D' || $perfilCrediticio == 'TIPO 5') {
					$customerIntention->INSPECCION_OCULAR = 1;
					$customerIntention->save();
				}
			}
		}

		// 3.6 Tarjeta Black
		$tarjeta = '';
		$aprobado = false;
		$quotaApprovedProduct = 0;
		$quotaApprovedAdvance = 0;
		if ($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1) {
			$aprobado =  $this->UpToDateFinancialCifinInterface->check12MonthsPaymentVector($identificationNumber);
			if ($aprobado == true) {
				$tarjeta = "Tarjeta Black";
				$quotaApprovedProduct = 1900000;
				$quotaApprovedAdvance = 500000;
			}
		}

		// 3.7 Tarjeta Gray
		if ($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1 && $aprobado == false) {
			if ($customer->ACTIVIDAD == 'PENSIONADO' || $customer->ACTIVIDAD == 'EMPLEADO') {
				$aprobado = true;
				$tarjeta = "Tarjeta Gray";
				$quotaApprovedProduct = 1600000;
				$quotaApprovedAdvance = 200000;
			}
		}

		if ($aprobado == true) {
			$customerIntention->TARJETA = $tarjeta;
			$customerIntention->save();
		}

		if ($aprobado == false && $perfilCrediticio == 'TIPO A') {
			if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($historialCrediticio == 1) {
					$customerIntention->ID_DEF  = '17';
				} else {
					$customerIntention->ID_DEF =  '18';
				}
			} else {
				$customerIntention->ID_DEF  = '15';
			}
			$customer->ESTADO           = 'PREAPROBADO';
			$tarjeta                    = "Crédito Tradicional";
			$customerIntention->TARJETA = $tarjeta;
			$customerIntention->ESTADO_INTENCION  = '2';
			$customer->save();
			$customerIntention->save();
			return ['resp' => "-2"];
		}

		// 2. WS Fosyga
		$estadoCliente = "PREAPROBADO";
		$statusAfiliationCustomer = true;
		$getDataFosyga = $this->fosygaInterface->getLastFosygaConsultation($identificationNumber);
		if (!empty($getDataFosyga)) {
			if (empty($getDataFosyga->estado) || empty($getDataFosyga->regimen) || empty($getDataFosyga->tipoAfiliado)) {
				return ['resp' => "false"];
			} else {
				if ($getDataFosyga->estado != 'ACTIVO' || $getDataFosyga->regimen != 'CONTRIBUTIVO' || $getDataFosyga->tipoAfiliado != 'COTIZANTE') {
					$statusAfiliationCustomer = false;
				}
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		// 4.6 Tipo 5 Especial
		$tipo5Especial = 0;
		if ($perfilCrediticio == 'TIPO 5' && ($customer->ACTIVIDAD == 'EMPLEADO' || $customer->ACTIVIDAD == 'PENSIONADO') && $statusAfiliationCustomer == true) {
			$tipo5Especial = 1;
		}

		$customerIntention->TIPO_5_ESPECiAL = $tipo5Especial;
		$customerIntention->save();

		//3.1 Estado de documento
		$getDataRegistraduria = $this->registraduriaInterface->getLastRegistraduriaConsultation($identificationNumber);
		if (!empty($getDataRegistraduria)) {
			if (!empty($getDataRegistraduria->estado)) {
				if ($getDataRegistraduria->estado != 'VIGENTE') {
					$customer->ESTADO                     = 'NEGADO';
					$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;
					$customerIntention->ID_DEF            =  '4';
					$customerIntention->ESTADO_INTENCION  = '1';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "false"];
				}
			} else {
				return ['resp' => "false"];
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		if ($customerStatusDenied == true) {
			$customer->ESTADO          = 'NEGADO';
			$customerIntention->ID_DEF =  $idDef;
			$customerIntention->ESTADO_INTENCION  = '1';
			$customer->save();
			$customerIntention->save();
			return ['resp' => "false"];
		}

		// 5 Definiciones cliente

		if($customer->ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA'){
			$customer->ESTADO = 'PREAPROBADO';
			$customer->save();
			$customerIntention->TARJETA          = 'Crédito Tradicional';
			$customerIntention->ID_DEF           = '13';
			$customerIntention->ESTADO_INTENCION = '2';
			$customerIntention->save();
			return ['resp' =>  "-2"];
		}

		if ($perfilCrediticio == 'TIPO A') {
			if ($statusAfiliationCustomer == true) {
				if ($tipoCliente == 'OPORTUNIDADES') {
					$customer->ESTADO = 'PREAPROBADO';
					$customer->save();
					$customerIntention->TARJETA =  $tarjeta;
					$customerIntention->ID_DEF =  '14';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
				}

				if ($customer->ACTIVIDAD == 'EMPLEADO' || $customer->ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS') {
					$customer->ESTADO           = 'PREAPROBADO';
					$customerIntention->TARJETA = $tarjeta;
					$customerIntention->ID_DEF  = '15';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
				}

				if ($customer->ACTIVIDAD == 'PENSIONADO') {
					$customer->ESTADO           = 'PREAPROBADO';
					$customerIntention->TARJETA = $tarjeta;
					$customerIntention->ID_DEF  = '16';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
				}

				if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
					if ($historialCrediticio == 1) {
						$customer->ESTADO           = 'PREAPROBADO';
						$customerIntention->TARJETA = $tarjeta;
						$customerIntention->ID_DEF  = '17';
						$customerIntention->ESTADO_INTENCION  = '2';
						$customer->save();
						$customerIntention->save();
						return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente];
					} else {
						$customer->ESTADO = 'PREAPROBADO';
						$customer->save();
						$customerIntention->TARJETA = 'Crédito Tradicional';
						$customerIntention->ID_DEF =  '18';
						$customerIntention->ESTADO_INTENCION  = '2';
						$customerIntention->save();
						return ['resp' => "-2"];
					}
				}
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '18';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO B') {
			if ($tipoCliente == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '19';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '20';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO C') {
			if ($tipoCliente == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '21';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '22';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO D') {
			if ($tipoCliente == 'OPORTUNIDADES' && $customerScore >= 275) {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '23';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'NEGADO';
				$customer->save();
				$customerIntention->TARJETA = '';
				$customerIntention->ID_DEF =  '24';
				$customerIntention->ESTADO_INTENCION  = '1';
				$customerIntention->save();
				return ['resp' => "false"];
			}
		}

		if ($perfilCrediticio == 'TIPO 5') {
			if ($tipo5Especial == 1) {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '12';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			}
			if ($tipoCliente == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '11';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '13';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			}
		}

		return ['resp' => "true"];
	}
	private function validatePolicyCredit_newAssessor($identificationNumber)
	{
		// 5	Puntaje y 3.4 Calificacion Score
		$customerStatusDenied = false;
		$idDef = "";
		$customer = $this->customerInterface->findCustomerById($identificationNumber);
		$customerScore = $this->cifinScoreInterface->getCustomerLastCifinScore($identificationNumber)->score;
		$data = ['CEDULA' => $identificationNumber];
		$customerIntention =  $this->intentionInterface->createIntention($data);

		if (empty($customer)) {
			return ['resp' => "false"];
		} else {
			if ($customerScore <= -8) {
				$customer->ESTADO = 'NEGADO';
				$customer->save();
				$perfilCrediticio                     = 'TIPO NE';
				$customerIntention->ID_DEF            = '8';
				$customerIntention->ESTADO_INTENCION  = '1';
				$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;
				$customerIntention->save();
				return ['resp' => "false"];
			}

			if ($customerScore >= 1 && $customerScore <= 275) {
				$customerStatusDenied = true;
				$idDef = '5';
				$perfilCrediticio = 'TIPO D';
			}

			if ($customerScore >= -7 && $customerScore <= 0) {
				$perfilCrediticio = 'TIPO 5';
			}

			if ($customerScore >= 275 && $customerScore <= 527) {
				$perfilCrediticio = 'TIPO D';
			}

			if ($customerScore >= 528 && $customerScore <= 624) {
				$perfilCrediticio = 'TIPO C';
			}

			if ($customerScore >= 625 && $customerScore <= 674) {
				$perfilCrediticio = 'TIPO B';
			}

			if ($customerScore >= 675 && $customerScore <= 1000) {
				$perfilCrediticio = 'TIPO A';
			}

			$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;
			$customerIntention->save();
		}

		// 3.3 Estado de obligaciones
		$respValorMoraFinanciero = $this->CifinFinancialArrearsInterface->checkCustomerHasCifinFinancialArrear($identificationNumber)->sum('finvrmora');
		$respValorMoraReal       = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealArrear($identificationNumber)->sum('rmvrmora');
		$totalValorMora          = $respValorMoraFinanciero + $respValorMoraReal;

		if ($totalValorMora > 100) {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "6";
			}
			$customerIntention->ESTADO_OBLIGACIONES = 0;
			$customerIntention->save();
		} else {
			$customerIntention->ESTADO_OBLIGACIONES = 1;
			$customerIntention->save();
		}

		$customerRealDoubtful = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealDoubtful($identificationNumber);
		$customerFinDoubtful = $this->CifinFinancialArrearsInterface->checkCustomerHasCifinFinancialDoubtful($identificationNumber);
		if ($customerRealDoubtful->isNotEmpty()) {
			if ($customerRealDoubtful[0]->rmsaldob > 0) {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "6";
				}
				$customerIntention->ESTADO_OBLIGACIONES = 0;
				$customerIntention->save();
			}
		}

		if ($customerFinDoubtful->isNotEmpty()) {
			if ($customerFinDoubtful[0]->finsaldob > 0) {
				if ($customerStatusDenied == false && empty($idDef)) {
					$customerStatusDenied = true;
					$idDef = "6";
				}
				$customerIntention->ESTADO_OBLIGACIONES = 0;
				$customerIntention->save();
			}
		}

		//3.5 Historial de Crédito
		$historialCrediticio = 0;
		$historialCrediticio = $this->UpToDateFinancialCifinInterface->check6MonthsPaymentVector($identificationNumber);

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->extintFinancialCifinInterface->check6MonthsPaymentVector($identificationNumber);
		}

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->UpToDateRealCifinInterface->check6MonthsPaymentVector($identificationNumber);
		}

		if ($historialCrediticio == 0) {
			$historialCrediticio = $this->extinctRealCifinInterface->check6MonthsPaymentVector($identificationNumber);
		}

		$customerIntention->HISTORIAL_CREDITO = $historialCrediticio;
		//4.1 Zona de riesgo
		$customerIntention->ZONA_RIESGO =  $this->subsidiaryInterface->getSubsidiaryRiskZone($customer->SUC)->ZONA;
		// 4.2 Tipo de cliente
		$tipoCliente = '';
		$queryGetClienteActivo = sprintf("SELECT COUNT(`CEDULA`) as tipoCliente
		FROM TB_CLIENTES_ACTIVOS
		WHERE `CEDULA` = %s AND FECHA >= date_add(NOW(), INTERVAL -24 MONTH)", $identificationNumber);

		$respClienteActivo = DB::connection('oportudata')->select($queryGetClienteActivo);
		if ($respClienteActivo[0]->tipoCliente == 1) {
			$tipoCliente = 'OPORTUNIDADES';
		} else {
			$tipoCliente = 'NUEVO';
		}

		$customerIntention->TIPO_CLIENTE = $tipoCliente;
		$customerIntention->save();

		// 4.3 Edad.
		$queryEdad = $this->cifinBasicDataInterface->checkCustomerHasCifinBasicData($identificationNumber)->teredad;
		if ($queryEdad == false || empty($queryEdad)) {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "9";
			}
			$customerIntention->EDAD = 0;
			$customerIntention->save();
		}

		if ($queryEdad == 'Mas 75') {
			if ($customerStatusDenied == false && empty($idDef)) {
				$customerStatusDenied = true;
				$idDef = "9";
			}
			$customerIntention->EDAD = 0;
			$customerIntention->save();
		} else {
			$queryEdad = explode('-', $queryEdad);
			$edadMin = $queryEdad[0];
			$edadMax = $queryEdad[1];

			$validateTipoCliente = TRUE;
			if ($customer->ACTIVIDAD == 'PENSIONADO') {
				$validateTipoCliente = FALSE;
				if ($edadMin >= 18 && $edadMax <= 80) {
					$customerIntention->EDAD = 1;
					$customerIntention->save();
				} else {
					if ($customerStatusDenied == false && empty($idDef)) {
						$customerStatusDenied = true;
						$idDef = "9";
					}
					$customerIntention->EDAD = 0;
					$customerIntention->save();
				}
			}

			if ($tipoCliente == 'OPORTUNIDADES' && $validateTipoCliente == TRUE) {
				if ($edadMin >= 18 && $edadMax <= 75) {
					$customerIntention->EDAD = 1;
					$customerIntention->save();
				} else {
					if ($customerStatusDenied == false && empty($idDef)) {
						$customerStatusDenied = true;
						$idDef = "9";
					}
					$customerIntention->EDAD = 0;
					$customerIntention->save();
				}
			}

			if ($tipoCliente == 'NUEVO' && $validateTipoCliente == TRUE) {
				if ($edadMin >= 18 && $edadMax <= 70) {
					$customerIntention->EDAD = 1;
					$customerIntention->save();
				} else {
					if ($customerStatusDenied == false && empty($idDef)) {
						$customerStatusDenied = true;
						$idDef = "9";
					}
					$customerIntention->EDAD = 0;
					$customerIntention->save();
				}
			}
		}


		// 4.5 Tiempo en Labor
		if ($customer->ACTIVIDAD == 'PENSIONADO') {
			$customerIntention->TIEMPO_LABOR = 1;
			$customerIntention->save();
		} else {
			if ($customer->ACTIVIDAD == 'RENTISTA' || $customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($customer->EDAD_INDP >= 4) {
					$customerIntention->TIEMPO_LABOR = 1;
					$customerIntention->save();
				} else {
					if ($customerStatusDenied == false && empty($idDef)) {
						$customerStatusDenied = true;
						$idDef = "10";
					}
					$customerIntention->TIEMPO_LABOR = 0;
					$customerIntention->save();
				}
			} else {
				if ($customer->ANTIG >= 4) {
					$customerIntention->TIEMPO_LABOR = 1;
					$customerIntention->save();
				} else {
					if ($customerStatusDenied == false && empty($idDef)) {
						$customerStatusDenied = true;
						$idDef = "10";
					}
					$customerIntention->TIEMPO_LABOR = 0;
					$customerIntention->save();
				}
			}
		}

		// 4.7 Inspecciones Oculares
		if ($tipoCliente == 'NUEVO') {
			if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($perfilCrediticio == 'TIPO C' || $perfilCrediticio == 'TIPO D' || $perfilCrediticio == 'TIPO 5') {
					$customerIntention->INSPECCION_OCULAR = 1;
					$customerIntention->save();
				}
			}
		}

		// 3.6 Tarjeta Black
		$tarjeta = '';
		$aprobado = false;
		$quotaApprovedProduct = 0;
		$quotaApprovedAdvance = 0;
		if ($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1) {
			$aprobado =  $this->UpToDateFinancialCifinInterface->check12MonthsPaymentVector($identificationNumber);
			if ($aprobado == true) {
				$tarjeta = "Tarjeta Black";
				$quotaApprovedProduct = 1900000;
				$quotaApprovedAdvance = 500000;
			}
		}

		// 3.7 Tarjeta Gray
		if ($perfilCrediticio == 'TIPO A' && $historialCrediticio == 1 && $aprobado == false) {
			if ($customer->ACTIVIDAD == 'PENSIONADO' || $customer->ACTIVIDAD == 'EMPLEADO') {
				$aprobado = true;
				$tarjeta = "Tarjeta Gray";
				$quotaApprovedProduct = 1600000;
				$quotaApprovedAdvance = 200000;
			}
		}

		if ($aprobado == true) {
			$customerIntention->TARJETA = $tarjeta;
			$customerIntention->save();
		}

		if ($aprobado == false && $perfilCrediticio == 'TIPO A') {
			if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
				if ($historialCrediticio == 1) {
					$customerIntention->ID_DEF  = '17';
				} else {
					$customerIntention->ID_DEF =  '18';
				}
			} else {
				$customerIntention->ID_DEF  = '15';
			}
			$customer->ESTADO           = 'PREAPROBADO';
			$tarjeta                    = "Crédito Tradicional";
			$customerIntention->TARJETA = $tarjeta;
			$customerIntention->ESTADO_INTENCION  = '2';
			$customer->save();
			$customerIntention->save();
			return ['resp' => "-2"];
		}

		// 2. WS Fosyga
		$estadoCliente = "PREAPROBADO";
		$fuenteFallo = "false";
		$statusAfiliationCustomer = true;
		$getDataFosyga = $this->fosygaInterface->getLastFosygaConsultationPolicy($identificationNumber);
		if (!empty($getDataFosyga)) {
			if ($getDataFosyga->fuenteFallo == 'SI') {
				$fuenteFallo = "true";
			} elseif (empty($getDataFosyga->estado) || empty($getDataFosyga->regimen) || empty($getDataFosyga->tipoAfiliado)) {
				$fuenteFallo = "true";
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		// 4.6 Tipo 5 Especial
		$tipo5Especial = 0;
		if ($perfilCrediticio == 'TIPO 5' && ($customer->ACTIVIDAD == 'EMPLEADO' || $customer->ACTIVIDAD == 'PENSIONADO') && $statusAfiliationCustomer == true) {
			$tipo5Especial = 1;
		}

		$customerIntention->TIPO_5_ESPECiAL = $tipo5Especial;
		$customerIntention->save();

		//3.1 Estado de documento
		$getDataRegistraduria = $this->registraduriaInterface->getLastRegistraduriaConsultationPolicy($identificationNumber);
		if (!empty($getDataRegistraduria)) {
			if ($getDataRegistraduria->fuenteFallo == 'SI') {
				$fuenteFallo = "true";
			} elseif (!empty($getDataRegistraduria->estado)) {
				if ($getDataRegistraduria->estado != 'VIGENTE') {
					$customer->ESTADO                     = 'NEGADO';
					$customerIntention->PERFIL_CREDITICIO = $perfilCrediticio;
					$customerIntention->ID_DEF            =  '4';
					$customerIntention->ESTADO_INTENCION  = '1';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "false"];
				}
			} else {
				$fuenteFallo = "true";
			}
		} else {
			$estadoCliente = "PREAPROBADO";
		}

		if ($customerStatusDenied == true) {
			$customer->ESTADO          = 'NEGADO';
			$customerIntention->ID_DEF =  $idDef;
			$customerIntention->ESTADO_INTENCION  = '1';
			$customer->save();
			$customerIntention->save();
			return ['resp' => "false"];
		}
		// 5 Definiciones cliente

		if ($customer->ACTIVIDAD == 'SOLDADO-MILITAR-POLICÍA') {
			$customer->ESTADO = 'PREAPROBADO';
			$customer->save();
			$customerIntention->TARJETA          = 'Crédito Tradicional';
			$customerIntention->ID_DEF           = '13';
			$customerIntention->ESTADO_INTENCION = '2';
			$customerIntention->save();
			return ['resp' =>  "-2"];
		}

		if ($perfilCrediticio == 'TIPO A') {
			if ($statusAfiliationCustomer == true) {
				if ($tipoCliente == 'OPORTUNIDADES') {
					$customer->ESTADO = 'PREAPROBADO';
					$customer->save();
					$customerIntention->TARJETA =  $tarjeta;
					$customerIntention->ID_DEF =  '14';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente, 'fuenteFallo' => $fuenteFallo];
				}

				if ($customer->ACTIVIDAD == 'EMPLEADO' || $customer->ACTIVIDAD == 'PRESTACIÓN DE SERVICIOS') {
					$customer->ESTADO           = 'PREAPROBADO';
					$customerIntention->TARJETA = $tarjeta;
					$customerIntention->ID_DEF  = '15';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente, 'fuenteFallo' => $fuenteFallo];
				}

				if ($customer->ACTIVIDAD == 'PENSIONADO') {
					$customer->ESTADO           = 'PREAPROBADO';
					$customerIntention->TARJETA = $tarjeta;
					$customerIntention->ID_DEF  = '16';
					$customerIntention->ESTADO_INTENCION  = '2';
					$customer->save();
					$customerIntention->save();
					return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente, 'fuenteFallo' => $fuenteFallo];
				}

				if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
					if ($historialCrediticio == 1) {
						$customer->ESTADO           = 'PREAPROBADO';
						$customerIntention->TARJETA = $tarjeta;
						$customerIntention->ID_DEF  = '17';
						$customerIntention->ESTADO_INTENCION  = '2';
						$customer->save();
						$customerIntention->save();
						return ['resp' => "true", 'quotaApprovedProduct' => $quotaApprovedProduct, 'quotaApprovedAdvance' => $quotaApprovedAdvance, 'estadoCliente' => $estadoCliente, 'fuenteFallo' => $fuenteFallo];
					} else {
						$customer->ESTADO = 'PREAPROBADO';
						$customer->save();
						$customerIntention->TARJETA = 'Crédito Tradicional';
						$customerIntention->ID_DEF =  '18';
						$customerIntention->ESTADO_INTENCION  = '2';
						$customerIntention->save();
						return ['resp' => "-2"];
					}
				}
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '18';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO B') {
			if ($tipoCliente == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '19';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '20';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO C') {
			if ($tipoCliente == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '21';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '22';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			}
		}

		if ($perfilCrediticio == 'TIPO D') {
			if ($tipoCliente == 'OPORTUNIDADES' && $customerScore >= 275) {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '23';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' => "-2"];
			} else {
				$customer->ESTADO = 'NEGADO';
				$customer->save();
				$customerIntention->TARJETA = '';
				$customerIntention->ID_DEF =  '24';
				$customerIntention->ESTADO_INTENCION  = '1';
				$customerIntention->save();
				return ['resp' => "false"];
			}
		}

		if ($perfilCrediticio == 'TIPO 5') {
			if ($tipo5Especial == 1) {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '12';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			}
			if ($tipoCliente == 'OPORTUNIDADES') {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '11';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			} else {
				$customer->ESTADO = 'PREAPROBADO';
				$customer->save();
				$customerIntention->TARJETA = 'Crédito Tradicional';
				$customerIntention->ID_DEF =  '13';
				$customerIntention->ESTADO_INTENCION  = '2';
				$customerIntention->save();
				return ['resp' =>  "-2"];
			}
		}
		return ['resp' => "true"];
	}
	private function validatePolicyCredit($identificationNumber, $subsidiaryCityName)
	{
		$queryScoreClient = DB::connection('oportudata')->select("SELECT score FROM cifin_score WHERE scocedula = :identificationNumber ORDER BY scoconsul DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);

		if (empty($queryScoreClient)) {
			return false;
		} else {
			$respScoreClient = $queryScoreClient[0]->score;

			/*$queryScoreCreditPolicy = DB::connection('mysql')->select("SELECT score FROM credit_policy LIMIT 1");
			$respScoreCreditPolicy = $queryScoreCreditPolicy[0]->score;*/
			$scoreMin = 528;
			if ($subsidiaryCityName == 'MEDELLÍN' || $subsidiaryCityName == 'BOGOTÁ') {
				$scoreMin = 726;
			}

			if ($respScoreClient >= -7 && $respScoreClient <= 0) {
				return true;
			}

			if ($respScoreClient >= $scoreMin) {
				return true;
			} else {
				$updateLeadState = DB::connection('oportudata')->select('UPDATE `CLIENTE_FAB` SET `ESTADO` = "RECHAZADO" WHERE `CEDULA` = :identificationNumber', ['identificationNumber' => $identificationNumber]);
				return false;
			}
		}
	}
	public function execCreditPolicy($identificationNumber)
	{
		$aprobado =  $this->UpToDateFinancialCifinInterface->check12MonthsPaymentVector($identificationNumber);

		if ($aprobado == false) {
			return -1; // Credito negado
		}

		// Negacion, codicion 2, saldo en mora
		$TotalCustomerCifinFinancialArrears = $this->CifinFinancialArrearsInterface->checkCustomerHasCifinFinancialArrear($identificationNumber)->sum('finvrmora');

		// $queryValorMoraFinanciero = sprintf("SELECT SUM(`finvrmora`) as totalMoraFin
		// FROM `cifin_finmora`
		// WHERE `finconsul` = (SELECT MAX(`finconsul`) FROM `cifin_finmora` WHERE `fincedula` = %s )
		// AND `fincedula` = %s AND `fincalid` != 'CODE' AND `fintipocon` != 'SRV' ", $identificationNumber, $identificationNumber);
		// $respValorMoraFinanciero = DB::connection('oportudata')->select($queryValorMoraFinanciero);


		$totalCustomerCifinRealArrears = $this->cifinRealArrearsInterface->checkCustomerHasCifinRealArrear($identificationNumber)->sum('rmvrmora');

		// $queryValorMoraReal = sprintf("SELECT SUM(`rmvrmora`) as totalMoraReal
		// FROM `cifin_realmora`
		// WHERE `rmconsul` = (SELECT MAX(`rmconsul`) FROM `cifin_realmora` WHERE `rmcedula` = %s )
		// AND `rmcedula` = %s AND (`rmtipoent` != 'COMU' OR `rmcalid` != 'CODE') AND `rmtipocon` != 'SRV' ", $identificationNumber, $identificationNumber);
		// $respValorMoraReal = DB::connection('oportudata')->select($queryValorMoraReal);
		// $totalValorMora = $respValorMoraFinanciero[0]->totalMoraFin + $respValorMoraReal[0]->totalMoraReal;

		$totalValorMora = $TotalCustomerCifinFinancialArrears + $totalCustomerCifinRealArrears;

		if ($totalValorMora > 100) {
			return -2; // Credito negado
		}

		return 1300000;
	}
}
