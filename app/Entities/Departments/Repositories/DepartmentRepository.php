<?php

namespace App\Entities\Departments\Repositories;

use App\Entities\Departments\Department;
use App\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Database\QueryException;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function __construct(
        Department $department
    ) {
        $this->model = $department;
    }

    public function getAllDepartments($identificationNumber)
    {
        try {
            return  $this->model->get();
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }

    public function getConfrontDepartments($customerDepartment){
        try {
            return  $this->model->where('NAME', '!=', $customerDepartment)->groupBy('NAME')->orderByRaw("RAND()")->limit(4)->get(['NAME']);
        } catch (QueryException $e) {
            dd($e);
            //throw $th;
        }
    }
}