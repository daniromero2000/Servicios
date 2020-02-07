<?php

namespace App\Entities\Customers\Repositories\Interfaces;

use App\Entities\Customers\Customer;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;


interface CustomerRepositoryInterface
{
  public function listCustomers($totalView): Support;

  public function listCustomersDigitalChannel();

  public function findCustomerById($identificationNumber): Customer;

  public function listCustomersTotal($from, $to);

  public function checkIfExists($identificationNumber);

  public function updateOrCreateCustomer($data);

  public function countCustomersSteps($from, $to);

  public function listCustomersForCall($totalView): Support;

  public function countCustomersForCallSteps($from, $to);

  public function findCustomerByIdFull($identificationNumber): Customer;
}