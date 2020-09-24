<?php

namespace App\Entities\CreditCards\Repositories;

use App\Entities\CreditCards\CreditCard;
use App\Entities\CreditCards\Repositories\Interfaces\CreditCardRepositoryInterface;
use Illuminate\Database\QueryException;

class CreditCardRepository implements CreditCardRepositoryInterface
{
	public function __construct(
		CreditCard $creditCard
	) {
		$this->model = $creditCard;
	}

	public function createCreditCard($numSolic, $identificationNumber, $cupoCompra, $cupoAvance, $sucursal, $tipoTarjetaAprobada)
	{
		$tipoTarjeta = "";
		if ($tipoTarjetaAprobada == 'Tarjeta Black') {
			$tipoTarjeta = 'BLACK';
		} elseif ($tipoTarjetaAprobada == 'Tarjeta Gray') {
			$tipoTarjeta = 'GRAY';
		}
		$tarjeta['NUMERO']     = "8712760999999";
		$tarjeta['SOLICITUD']  = $numSolic;
		$tarjeta['CLIENTE']    = $identificationNumber;
		$tarjeta['APROBACION'] = "0";
		$tarjeta['DESPACHO']   = "0000-00-00";
		$tarjeta['LOTE']       = "0";
		$tarjeta['FEC_APROB']  = "0000-00-00";
		$tarjeta['CUOTA_MAN']  = "9900";
		$tarjeta['CARGO']      = "9300";
		$tarjeta['CUP_INICIA'] = $cupoCompra;
		$tarjeta['CUP_COMPRA'] = $cupoCompra;
		$tarjeta['COMPRA_ACT'] = $cupoCompra;
		$tarjeta['COMPRA_EFE'] = "0";
		$tarjeta['CUPO_EFEC']  = $cupoAvance;
		$tarjeta['CUP_ACTUAL'] = $cupoAvance;
		$tarjeta['CUPOMAX']    = 480000;
		$tarjeta['SUC']        = $sucursal;
		$tarjeta['ESTADO']     = "I";
		$tarjeta['FEC_ACTIV']  = "0000-00-00";
		$tarjeta['CONS']       = "0";
		$tarjeta['OPORTUNID']  = "0";
		$tarjeta['EXTRACUPO']  = "0";
		$tarjeta['EXTRA_ACT']  = "0";
		$tarjeta['RECEPC1']    = "";
		$tarjeta['RECEPC2']    = "";
		$tarjeta['RECEPC3']    = "";
		$tarjeta['FEC_REC']    = "0000-00-00";
		$tarjeta['OBSTAR1']    = "";
		$tarjeta['OBSTAR2']    = "";
		$tarjeta['OBSTAR3']    = "";
		$tarjeta['TIPO_TAR']   = $tipoTarjeta;
		$tarjeta['RESPUEST']   = "";
		$tarjeta['RECEPCOFI']  = "";
		$tarjeta['OBSTAROFI']  = "";
		$tarjeta['FEC_RECOFI'] = "0000-00-00";
		$tarjeta['RECEPCSUC']  = "";
		$tarjeta['OBSTARSUC']  = "";
		$tarjeta['FEC_RECSUC'] = "0000-00-00";
		$tarjeta['RECEPCCLI']  = "";
		$tarjeta['OBSTARCLI']  = "";
		$tarjeta['FEC_RECCLI'] = "0000-00-00";
		$tarjeta['FTP']        = 0;
		$tarjeta['TOKEN_CE']   = "";
		$tarjeta['CELULAR_CE'] = "";
		$tarjeta['STATE']      = "A";
		$tarjeta['ANALISTA']   = "SI";

		try {
			return $this->model->create($tarjeta);
		} catch (QueryException $e) {
			//throw $th;
		}
	}

	public function checkCustomerHasCreditCard($identificationNumber)
	{
		try {
			$queryExistCard = $this->model->where('CLIENTE', $identificationNumber)->get()->first();
			if (!empty($queryExistCard)) {
				return true; // Tiene tarjeta
			} else {
				return false; // No tiene tarjeta
			}
		} catch (QueryException $e) {
			//throw $th;
		}
	}

	public function checkCustomerHasCreditCardActive($identificationNumber)
	{
		try {
			$queryExistCard = $this->model->where('CLIENTE', $identificationNumber)->where('STATE', 'A')->whereNotIn('ESTADO', ['A', 'P'])->get(['NUMERO', 'ESTADO', 'TIPO_TAR', 'STATE'])->first();
			if (!empty($queryExistCard)) {
				return true; // Tiene tarjeta Inactiva
			} else {
				return false; // No tiene tarjeta Inactiva
			}
		} catch (QueryException $e) {
			//throw $th;
		}
	}

	public function validateCreditCardStatus($aprobado, $customer, $customerIntention, $idDef)
	{
		if ($aprobado) {
			if ($customer->creditCard) {
				if ($customer->creditCard->ESTADO == 'B') {
					$idDef     = 26;
				} elseif ($customerIntention->PERFIL_CREDITICIO == 'TIPO A' || $customerIntention->PERFIL_CREDITICIO == 'TIPO B') {
					$idDef     = 25;
				}
			}
		} else {
			if ($customer->creditCard) {
				if ($customer->creditCard->ESTADO == 'B') {
					$idDef     = 26;
				} elseif ($customerIntention->PERFIL_CREDITICIO == 'TIPO A' || $customerIntention->PERFIL_CREDITICIO == 'TIPO B') {
					$idDef     = 25;
				}
			}
		}
		return $idDef;
	}
}
