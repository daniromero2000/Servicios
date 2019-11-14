<?php

namespace App\Entities\Customers\Repositories\Interfaces;


interface CustomerRepositoryInterface
{
  public function listCustomers();

  public function listCustomersDigitalChannel();
}
