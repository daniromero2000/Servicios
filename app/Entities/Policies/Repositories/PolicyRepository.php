<?php

namespace App\Entities\Policies\Repositories;

use App\Entities\Policies\Policy;
use App\Entities\Policies\Repositories\Interfaces\PolicyRepositoryInterface;

class PolicyRepository implements PolicyRepositoryInterface
{
    public function __construct(Policy $policy)
    {
        $this->model = $policy;
    }

    public function CheckScorePolicy($customerScore)
    {
        if ($customerScore >= -7 && $customerScore <= 0) {
            return 'TIPO 5';
        }

        if ($customerScore >= 275 && $customerScore <= 527) {
            return 'TIPO D';
        }

        if ($customerScore >= 528 && $customerScore <= 624) {
            return  'TIPO C';
        }

        if ($customerScore >= 625 && $customerScore <= 674) {
            return 'TIPO B';
        }

        if ($customerScore >= 675 && $customerScore <= 1000) {
            return  'TIPO A';
        }

        if ($customerScore <= -8) {
            return 'TIPO 7';
        }
    }

    public function validateCustomerAge($customer, $customerStatusDenied, $tipoCliente)
    {
        $idDef = "";
        $edad = 0;
        // 4.3 Edad.
        if ($customer->EDAD == false || empty($customer->EDAD)) {
            if ($customerStatusDenied == false && empty($idDef)) {
                $customerStatusDenied = true;
                $idDef = "9";
            }
            $edad = 0;
        }

        if ($customer->EDAD > 80) {

            if ($customerStatusDenied == false && empty($idDef)) {
                $customerStatusDenied = true;
                $idDef = "9";
            }
            $edad = 0;
        } else {
            $validateTipoCliente = TRUE;
            if ($customer->ACTIVIDAD == 'PENSIONADO') {
                $validateTipoCliente = FALSE;
                if ($customer->EDAD >= 18 && $customer->EDAD <= 80) {
                    $edad = 1;
                } else {
                    if ($customerStatusDenied == false && empty($idDef)) {
                        $customerStatusDenied = true;
                        $idDef = "9";
                    }
                    $edad = 0;
                }
            }

            if ($tipoCliente == 'OPORTUNIDADES' && $validateTipoCliente == TRUE) {
                if ($customer->EDAD >= 18 && $customer->EDAD <= 75) {
                    $edad = 1;
                } else {
                    if ($customerStatusDenied == false && empty($idDef)) {
                        $customerStatusDenied = true;
                        $idDef = "9";
                    }
                    $edad = 0;
                }
            }

            if ($tipoCliente == 'NUEVO' && $validateTipoCliente == TRUE) {

                if ($customer->EDAD >= 18 && $customer->EDAD <= 70) {
                    $edad = 1;
                } else {
                    if ($customerStatusDenied == false && empty($idDef)) {
                        $customerStatusDenied = true;
                        $idDef = "9";
                    }
                    $edad = 0;
                }
            }
        }

        return ['customerStatusDenied' => $customerStatusDenied, 'idDef' => $idDef, 'edad' => $edad];
    }

    public function validateLabourTime($customer, $customerStatusDenied)
    {
        $idDef = "";
        $labor = 0;
        // 4.5 Tiempo en Labor
        if ($customer->ACTIVIDAD == 'PENSIONADO') {
            $labor = 1;
        } else {
            if ($customer->ACTIVIDAD == 'RENTISTA' || $customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
                if ($customer->EDAD_INDP >= 4) {
                    $labor = 1;
                } else {
                    if ($customerStatusDenied == false && empty($idDef)) {
                        $customerStatusDenied = true;
                        $idDef = "10";
                    }
                    $labor = 0;
                }
            } else {
                if ($customer->ANTIG >= 4) {
                    $labor = 1;
                } else {
                    if ($customerStatusDenied == false && empty($idDef)) {
                        $customerStatusDenied = true;
                        $idDef = "10";
                    }
                    $labor = 0;
                }
            }
        }

        return ['customerStatusDenied' => $customerStatusDenied, 'idDef' => $idDef, 'labor' => $labor];
    }


    public function validaOccularInspection($customer, $tipoCliente, $perfilCrediticio)
    {
        $ocular = 0;
        // 4.7 Inspecciones Oculares
        if ($tipoCliente == 'NUEVO') {
            if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
                if ($perfilCrediticio == 'TIPO C' || $perfilCrediticio == 'TIPO D' || $perfilCrediticio == 'TIPO 5') {
                    $ocular = 1;
                }
            }
        }
        return  $ocular;
    }
}
