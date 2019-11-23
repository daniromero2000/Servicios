<?php

namespace App\Http\Controllers\Front\Insurances;

use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
use Carbon\Carbon;

class SegurosController extends Controller
{
    private $customerInterface, $subsidiaryInterface, $customerCellPhoneInterface;

    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        CustomerCellPhoneRepositoryInterface $customerCellPhoneRepositoryInterface
    ) {
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->customerInterface       = $customerRepositoryInterface;
        $this->customerCellPhoneInterface        = $customerCellPhoneRepositoryInterface;
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
        $birthday            = new Carbon($request->FEC_NAC);
        $subsidiaryCityName  = $this->subsidiaryInterface->getSubsidiaryCityByCode($request->get('CIUD_UBI'))->CIUDAD;
        $request['EDAD']     = $birthday->diffInYears(Carbon::now());
        $request['SUC']      = $request->get('CIUD_UBI');
        $request['CIUD_UBI'] = $subsidiaryCityName;
        $request['POSEEVEH'] = "S";

        $this->customerInterface->updateOrCreateCustomer($request->input());

        if (empty($this->customerCellPhoneInterface->checkIfExists($request->input('CEDULA'), $request->input('CELULAR')))) {
            $clienteCelular = [];
            $clienteCelular['IDENTI'] = $request->input('CEDULA');
            $clienteCelular['NUM'] = trim($request->get('CELULAR'));
            $clienteCelular['TIPO'] = 'CEL';
            $clienteCelular['CEL_VAL'] = 1;
            $clienteCelular['FECHA'] = date("Y-m-d H:i:s");
            $this->customerCellPhoneInterface->createCustomerCellPhone($clienteCelular);
        }
    }
}
