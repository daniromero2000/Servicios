<?php

namespace App\Entities\Policies\Repositories\Interfaces;


interface PolicyRepositoryInterface
{
    public function CheckScorePolicy($customerScore);

    public function validateCustomerAge($customer, $customerStatusDenied, $customerIntention);

    public function validateLabourTime($customer, $customerStatusDenied);

    public function validaOccularInspection($customer, $tipoCliente, $perfilCrediticio);

    public function validateTipoEspecial($perfilCrediticio, $actividad, $statusAfiliationCustomer);
}
