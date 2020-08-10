<?php

namespace App\Entities\Policies\Repositories\Interfaces;


interface PolicyRepositoryInterface
{
    public function CheckScorePolicy($customerScore);

    public function validateCustomerAge($customer, $customerStatusDenied, $customerIntention, $idDef);

    public function validateLabourTime($customer, $customerStatusDenied, $idDef);

    public function validaOccularInspection($customer, $tipoCliente, $perfilCrediticio);

    public function validateTipoEspecial($perfilCrediticio, $actividad, $statusAfiliationCustomer);

    public function validateCustomerArreas($respValorMoraFinanciero, $respValorMoraReal, $customerStatusDenied, $idDef);
}
