<?php

namespace App\Http\Controllers\Admin\TemporaryCustomers;

use App\Entities\TemporaryCustomers\Repositories\Interfaces\TemporaryCustomerRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TemporaryCustomerController extends Controller
{
    private $request;

    public function __construct(
        Request $request
    ) {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    }

    public function show(int $id)
    {
    }

    public function execFosygaConsultation($identificationNumber)
    {
    }

    public function execRegistraduriaConsultation($identificationNumber)
    {
    }

    public function dashboard()
    {
    }

    public function updatePoliceDebtors()
    {
    }

    public function getPoliceDebtors($identificationNumber)
    {
    }

    public function getPoliceDebtorOportuyas($identificationNumber)
    {
    }
}