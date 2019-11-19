<?php

namespace App\Entities\Employees\Repositories;

use App\Entities\Employees\Employee;
use App\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Database\QueryException;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(
        Employee $employee
    ) {
        $this->model = $employee;
    }

    public function checkCustomerIsEmployee($identificationNumber)
    {
        try {
            $queryExistEmployed = $this->model
                ->where('num_documento', $identificationNumber)
                ->where('estado', 1)->get()->first();
            if (!empty($queryExistEmployed)) {
                return true; // Es empleado
            } else {
                return false; // No es empelado
            }
        } catch (QueryException $e) {
            //throw $th;
        }
    }
}
