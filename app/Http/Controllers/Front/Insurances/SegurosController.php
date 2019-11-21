<?php

namespace App\Http\Controllers\Front\Insurances;

use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Carbon\Carbon;

class SegurosController extends Controller
{
    private $leadInterface, $subsidiaryInterface;

    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
    ) {
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->customerInterface       = $customerRepositoryInterface;
    }

    public function index()
    {
        return view('seguros.index', [
            'images' =>  Imagenes::all(),
            'cities' => $this->subsidiaryInterface->getAllSubsidiaryCityNames()
        ]);
    }

    public function store(Request $request)
    {
        $birthday = new Carbon($request->FEC_NAC);
        $request['EDAD'] = $birthday->diffInYears(Carbon::now());
        return $this->customerInterface->updateOrCreateCustomer($request->input());
    }
}
