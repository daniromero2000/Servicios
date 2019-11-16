<?php

namespace App\Entities\Customers\Repositories\Interfaces;

use App\Entities\Customers\Customer;


interface CustomerRepositoryInterface
{
  public function listCustomers();

  public function listCustomersDigitalChannel();

  public function findCustomerById($identificationNumber): Customer;

  public function checkIfExists($identificationNumber);

  public function createCustomer($data): Customer;
}
