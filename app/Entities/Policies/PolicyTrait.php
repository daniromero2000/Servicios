<?php

namespace App\Entities\Policies;

use App\Entities\DebtorInsurances\DebtorInsurance;
use Illuminate\Support\Facades\DB;

trait PolicyTrait
{

  private function getInfoLeadCreate($identificationNumber)
  {
    $queryDataLead = DB::connection('oportudata')->select('SELECT cf.`TIPO_DOC`, cf.`CEDULA`, inten.`TIPO_CLIENTE`, cf.`FEC_NAC`, cf.`TIPOV`, cf.`ACTIVIDAD`, cf.`ACT_IND`, inten.`TIEMPO_LABOR`, cf.`SUELDO`, cf.`OTROS_ING`, cf.`SUELDOIND`, cf.`SUC`, cf.`DIRECCION`, cf.`CELULAR`, cf.`CREACION`, cfs.`score`, inten.`TARJETA`, cf.`ESTADO`, inten.`ID_DEF`, def.`DESCRIPCION`, def.`CARACTERISTICA`
		FROM `CLIENTE_FAB` as cf
		LEFT JOIN `TB_INTENCIONES` as inten ON inten.`CEDULA` = cf.`CEDULA`
		LEFT JOIN `TB_DEFINICIONES` as def ON def.id = inten.`ID_DEF`
		LEFT JOIN `cifin_score` as cfs ON cf.`CEDULA` = cfs.`scocedula`
		WHERE inten.`CEDULA` = :cedula AND cfs.`scoconsul` = (SELECT MAX(`scoconsul`) FROM `cifin_score` WHERE `scocedula` = :cedulaScore )
		ORDER BY FECHA_INTENCION DESC
		LIMIT 1', ['cedula' => $identificationNumber, 'cedulaScore' => $identificationNumber]);

    return $queryDataLead[0];
  }

  public function getHistorialCrediticio($identificationNumber)
  {

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
    return $historialCrediticio;
  }

  public function doUbica($customer, $customerIntention)
  {
    $estadoSolic = 1;
    $lastName = $this->customerInterface->getcustomerFirstLastName($customer->APELLIDOS);
    $this->ubicaInterface->doConsultaUbica($customer, $lastName, $this->daysToIncrement);
    $resultUbica = $this->validateConsultaUbica($customer);

    if ($resultUbica == 0) {
      $fechaExpIdentification = $this->toolsInterface->getConfrontaDateFormat($customer->FEC_EXP);
      $confronta = $this->webServiceInterface->execConsultaConfronta($customer->TIPO_DOC, $customer->CEDULA, $fechaExpIdentification, $lastName);
      if ($confronta == 1) {
        $form = $this->toolsInterface->getFormConfronta($customer->CEDULA);
        if (empty($form)) {
          $customerIntention->save();
          $estadoSolic = 1;
        } else {
          $customerIntention->save();
          return [
            'form' => $form,
            'resp' => 'confronta'
          ];
        }
      } else {
        $customerIntention->save();
        $estadoSolic = 1;
      }
    } else {
      $customerIntention->ID_DEF = '27';
      $estadoSolic = 19;
    }

    return  $estadoSolic;
  }

  public function validateConsultaUbica($customer)
  {
    $customerPhone = $customer->checkedPhone;
    $celLead       = 0;

    if (!empty($customerPhone)) {
      $celLead =  $customerPhone =  $customer->checkedPhone->NUM;
    }

    $aprobo = 0;
    $consec = $customer->lastUbicaConsultation->consec;
    $telConsultaUbica = $this->ubicaCellPhoneInterfac->getUbicaCellPhoneByConsec($celLead, $consec);

    if ($telConsultaUbica->isNotEmpty()) {
      $aprobo = $this->ubicaInterface->validateDateUbica($telConsultaUbica[0]->ubiprimerrep);
    } else {
      $aprobo = 0;
    }

    if ($aprobo == 0) {
      // Validacion Telefono empresarial
      if ($customer->TEL_EMP != '' && $customer->TEL_EMP != '0') {
        $telEmpConsultaUbica = DB::connection('oportudata')->select("SELECT `ubiprimerrep`
				FROM `ubica_telefono`
				WHERE `ubitipoubi` LIKE '%LAB%'
				AND `ubiconsul` = :consec
				AND (`ubitelefono` = :tel_emp
				OR `ubitelefono` = :tel2_emp ) ", ['consec' => $consec, 'tel_emp' => $customer->TEL_EMP, 'tel2_emp' => $customer->TEL2_EMP]);
        if (!empty($telEmpConsultaUbica)) {
          $aprobo = $this->ubicaInterface->validateDateUbica($telEmpConsultaUbica[0]->ubiprimerrep);
        } else {
          $aprobo = 0;
        }
      } else {
        $aprobo = 0;
      }
    }

    if ($aprobo == 0) {
      // Validacion Correo
      if ($customer->EMAIL != '') {
        $emailConsultaUbica = $this->ubicaMailInterface->getUbicaEmailByConsec($customer->EMAIL, $consec);
        if ($emailConsultaUbica->isNotEmpty()) {
          $aprobo = $this->ubicaInterface->validateDateUbica($emailConsultaUbica[0]->ubiprimerrep);
        }
      } else {
        $aprobo = 0;
      }
    }
    return $aprobo;
  }

  private function addSolicCredit($customer, $policyCredit, $estadoSolic, $data)
  {
    $this->webServiceInterface->execMigrateCustomer($customer->CEDULA);

    $factoryRequest = $this->addSolicFab(
      $customer,
      $policyCredit['quotaApprovedProduct'],
      $policyCredit['quotaApprovedAdvance'],
      $estadoSolic
    );
    dd($factoryRequest);

    $this->datosClienteInterface->addDatosCliente($customer, $factoryRequest, $data);
    $fosygaTemp = $customer->customerFosygaTemps->first();

    $analisisData = [
      'solicitud' => $factoryRequest->SOLICITUD,
    ];

    if ($fosygaTemp) {
      $analisisData['paz_cli']     = $fosygaTemp->paz_cli;
      $analisisData['fos_cliente'] = $fosygaTemp->fos_cliente;
    }

    $this->analisisInterface->addAnalisis($analisisData);

    $infoLead        = (object) [];
    if ($estadoSolic != 3) {
      $infoLead = $this->getInfoLeadCreate($customer->CEDULA);
    }

    $infoLead->numSolic = $factoryRequest->SOLICITUD;

    if ($estadoSolic == 19) {
      $customer->ESTADO = "APROBADO";
      $customer->save();
      $customerIntention = $customer->latestIntention;
      $customerIntention->ESTADO_INTENCION = 4;
      $customerIntention->save();
      $estadoResult = "APROBADO";

      $existCard = $this->creditCardInterface->checkCustomerHasCreditCard($customer->CEDULA);
      if ($existCard == true) {
      } else {
        $this->creditCardInterface->createCreditCard(
          $factoryRequest->SOLICITUD,
          $customer->CEDULA,
          $policyCredit['quotaApprovedProduct'],
          $policyCredit['quotaApprovedAdvance'],
          $infoLead->SUC,
          $infoLead->TARJETA
        );
      }
    } elseif ($estadoSolic == 1) {
      $debtor         = new DebtorInsurance();
      $debtor->CEDULA = $customer->CEDULA;
      $debtor->SOLIC  = $factoryRequest->SOLICITUD;
      $debtor->save();
      $estadoResult = "PREAPROBADO";
    } else {
      $estadoResult  = "PREAPROBADO";
      $respScoreLead = $customer->latestCifinScore;
      $scoreLead     = 0;
      if (!empty($respScoreLead)) {
        $scoreLead = $respScoreLead->score;
      }

      $turnData = [
        'SOLICITUD' => $factoryRequest->SOLICITUD,
        'CEDULA'    => $customer->CEDULA,
        'SUC'       => $factoryRequest->SUCURSAL,
        'SCORE'     => $scoreLead,
      ];

      $this->OportuyaTurnInterface->addOportuyaTurn($turnData);
    }
    $customer->ESTADO = $estadoResult;
    $customer->save();
    $infoLead = (object) [];

    if ($estadoSolic != 3) {
      $infoLead = $this->getInfoLeadCreate($customer->CEDULA);
    }
    $infoLead->numSolic = $factoryRequest->SOLICITUD;
    $infoLead->ESTADO = $factoryRequest->ESTADO;

    return [
      'estadoCliente'        => $estadoResult,
      'resp'                 => $policyCredit['resp'],
      'infoLead'             => $infoLead,
      'quotaApprovedProduct' => $policyCredit['quotaApprovedProduct'],
      'quotaApprovedAdvance' => $policyCredit['quotaApprovedAdvance']
    ];
  }

  private function addSolicFab($customer, $quotaApprovedProduct = 0, $quotaApprovedAdvance = 0, $estado)
  {
    $assessorData      = $this->assessorInterface->findAssessorById($customer->USUARIO_ACTUALIZACION);

    $requestData = [
      'AVANCE_W'      => $quotaApprovedAdvance,
      'PRODUC_W'      => $quotaApprovedProduct,
      'CLIENTE'       => $customer->CEDULA,
      'CODASESOR'     => $customer->USUARIO_ACTUALIZACION,
      'id_asesor'     => $customer->USUARIO_ACTUALIZACION,
      'ID_EMPRESA'    => $assessorData->ID_EMPRESA,
      'SUCURSAL'      => $customer->SUC,
      'ESTADO'        => $estado,
      'SOLICITUD_WEB' => $customer->latestIntention->id
    ];

    $customerFactoryRequest = $this->factoryRequestInterface->addFactoryRequest($requestData);
    $this->codebtorInterface->createCodebtor($customerFactoryRequest->SOLICITUD);
    $this->secondCodebtorInterface->createSecondCodebtor($customerFactoryRequest->SOLICITUD);
    $customerFactoryRequest->states()->attach($estado, ['usuario' => $assessorData->NOMBRE]);
    return $customerFactoryRequest;
  }
}
