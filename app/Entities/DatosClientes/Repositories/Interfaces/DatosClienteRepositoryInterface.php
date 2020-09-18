<?php

namespace App\Entities\DatosClientes\Repositories\Interfaces;

interface DatosClienteRepositoryInterface
{
    public function addDatosCliente($customer, $factoryRequest, $data);
}
