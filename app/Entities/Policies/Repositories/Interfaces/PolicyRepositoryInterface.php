<?php

namespace App\Entities\Policies\Repositories\Interfaces;


interface PolicyRepositoryInterface
{
    public function CheckScorePolicy($customerScore);

    public function validateCustomerAge($customer, $customerStatusDenied, $customerIntention, $idDef);

    public function validateLabourTime($customer, $customerStatusDenied, $idDef);

    public function validaOccularInspection($customer, $customerIntention);

    public function validateTipoEspecial($perfilCrediticio, $actividad, $statusAfiliationCustomer);

    public function validateCustomerArreas($respValorMoraFinanciero, $respValorMoraReal, $customerStatusDenied, $idDef);

    public function tipoAConHistorial($customerIntention);

    public function pensionadoOEmpleado($customer);
}
