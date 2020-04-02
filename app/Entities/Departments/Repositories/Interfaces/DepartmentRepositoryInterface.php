<?php

namespace App\Entities\Departments\Repositories\Interfaces;


interface DepartmentRepositoryInterface
{
    public function getAllDepartments($identificationNumber);

    public function getConfrontDepartments($customerDepartment);
}