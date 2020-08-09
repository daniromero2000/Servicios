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

    public function validateCustomerAge($customer, $customerStatusDenied, $customerIntention)
    {
        // 4.3 Edad.
        if ($customer->EDAD == false || empty($customer->EDAD)) {
            if ($customerStatusDenied == false && empty($idDef)) {
                $customerStatusDenied = true;
                $idDef = "9";
            }
            $customerIntention->EDAD = 0;
            $customerIntention->save();
        }

        if ($customer->EDAD > 80) {
            if ($customerStatusDenied == false && empty($idDef)) {
                $customerStatusDenied = true;
                $idDef = "9";
            }
            $customerIntention->EDAD = 0;
            $customerIntention->save();
        } else {
            $validateTipoCliente = TRUE;
            if ($customer->ACTIVIDAD == 'PENSIONADO') {
                $validateTipoCliente = FALSE;
                if ($customer->EDAD >= 18 && $customer->EDAD <= 80) {
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

            if ($customerIntention->TIPO_CLIENTE == 'OPORTUNIDADES' && $validateTipoCliente == TRUE) {
                if ($customer->EDAD >= 18 && $customer->EDAD <= 75) {
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

            if ($customerIntention->TIPO_CLIENTE == 'NUEVO' && $validateTipoCliente == TRUE) {
                if ($customer->EDAD >= 18 && $customer->EDAD <= 70) {
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

        return true;
    }
}
