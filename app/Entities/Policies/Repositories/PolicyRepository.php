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
        $customerStatusDenied  = false;
        $idDef                 = "";
        $perfilCrediticio = "";

        if ($customerScore >= -7 && $customerScore <= 0) {
            $perfilCrediticio = 'TIPO 5';
        }

        if ($customerScore >= 1 && $customerScore <= 275) {
            $customerStatusDenied = true;
            $idDef                = '5';
            $perfilCrediticio     = 'TIPO D';
        }

        if ($customerScore >= 275 && $customerScore <= 527) {
            $perfilCrediticio =  'TIPO D';
        }

        if ($customerScore >= 528 && $customerScore <= 624) {
            $perfilCrediticio =  'TIPO C';
        }

        if ($customerScore >= 625 && $customerScore <= 674) {
            $perfilCrediticio =  'TIPO B';
        }

        if ($customerScore >= 675 && $customerScore <= 1000) {
            $perfilCrediticio =  'TIPO A';
        }

        if ($customerScore <= -8) {
            $idDef                 = '8';
            $perfilCrediticio =  'TIPO 7';
        }

        return ['customerStatusDenied' => $customerStatusDenied, 'idDef' => $idDef, 'perfilCrediticio' => $perfilCrediticio];
    }

    public function validateCustomerAge($customer, $customerStatusDenied, $tipoCliente, $idDef)
    {
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

    public function validateLabourTime($customer, $customerStatusDenied, $idDef)
    {
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


    public function validaOccularInspection($customer, $customerIntention)
    {
        $ocular = 0;
        // 4.7 Inspecciones Oculares
        if ($customerIntention->TIPO_CLIENTE == 'NUEVO') {
            if ($customer->ACTIVIDAD == 'INDEPENDIENTE CERTIFICADO' || $customer->ACTIVIDAD == 'NO CERTIFICADO') {
                if ($customerIntention->PERFIL_CREDITICIO == 'TIPO C' || $customerIntention->PERFIL_CREDITICIO == 'TIPO D' || $customerIntention->PERFIL_CREDITICIO == 'TIPO 5') {
                    $ocular = 1;
                }
            }
        }
        return  $ocular;
    }

    public function validateTipoEspecial($perfilCrediticio, $actividad, $statusAfiliationCustomer)
    {
        // 4.6 Tipo 5 Especial
        $tipo5Especial = 0;
        if ($perfilCrediticio == 'TIPO 5' && ($actividad == 'EMPLEADO' || $actividad == 'PENSIONADO') && $statusAfiliationCustomer == true) {
            $tipo5Especial = 1;
        }

        return $tipo5Especial;
    }

    public function validateCustomerArreas($respValorMoraFinanciero, $respValorMoraReal, $customerStatusDenied, $idDef)
    {
        $arreas = 0;
        if (($respValorMoraFinanciero + $respValorMoraReal) > 100) {
            if ($customerStatusDenied == false && empty($idDef)) {
                $customerStatusDenied = true;
                $idDef = "6";
            }
            $arreas = 0;
        } else {
            $arreas = 1;
        }

        return ['customerStatusDenied' => $customerStatusDenied, 'idDef' => $idDef, 'arreas' => $arreas];
    }

    public function tipoAConHistorial($customerIntention)
    {
        return ($customerIntention->PERFIL_CREDITICIO == 'TIPO A' && $customerIntention->HISTORIAL_CREDITO == 1);
    }

    public function pensionadoOEmpleado($customer)
    {
        return ($customer->ACTIVIDAD == 'PENSIONADO' || $customer->ACTIVIDAD == 'EMPLEADO');
    }
}
