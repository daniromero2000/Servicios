<?php

namespace App\Entities\Customers\Repositories\Interfaces;

use App\Entities\Customers\Customer;
use Illuminate\Support\Collection as Support;


interface CustomerRepositoryInterface
{
  public function listCustomers($totalView): Support;

  public function listCustomersDigitalChannel();

  public function findCustomerById($identificationNumber): Customer;

  public function checkIfExists($identificationNumber);

  public function updateOrCreateCustomer($data);
}
