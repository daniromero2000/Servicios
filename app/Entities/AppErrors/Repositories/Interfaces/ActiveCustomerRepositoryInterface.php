<?php

namespace App\Entities\ActiveCustomers\Repositories\Interfaces;

use App\Entities\ActiveCustomers\ActiveCustomer;


interface ActiveCustomerRepositoryInterface
{
  public function listActiveCustomers();

  public function listActiveCustomersDigitalChannel();

  public function findActiveCustomerById($identificationNumber): ActiveCustomer;

  public function checkIfExists($identificationNumber);

  public function updateOrCreateActiveCustomer($data);
}
