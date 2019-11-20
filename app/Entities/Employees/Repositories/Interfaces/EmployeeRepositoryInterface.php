<?php

namespace App\Entities\Employees\Repositories\Interfaces;

interface EmployeeRepositoryInterface
{
  public function checkCustomerIsEmployee($identificationNumber);
}
