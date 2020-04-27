<?php

namespace App\Http\Controllers\Front\ConfrontaCustomers;

use App\cliCel;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
use App\Entities\ConfrontForms\Repositories\Interfaces\ConfrontFormRepositoryInterface;
use App\Entities\Customers\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConfrontaCustomerController extends Controller
{
    private $customerInterface, $subsidiaryInterface, $customerCellPhoneInterface, $cityInterface;

    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        CustomerCellPhoneRepositoryInterface $customerCellPhoneRepositoryInterface,
        ConfrontFormRepositoryInterface $confrontFormRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface
    ) {
        $this->subsidiaryInterface        = $subsidiaryRepositoryInterface;
        $this->customerInterface          = $customerRepositoryInterface;
        $this->customerCellPhoneInterface = $customerCellPhoneRepositoryInterface;
        $this->confrontFormInterface         = $confrontFormRepositoryInterface;
        $this->cityInterface              = $cityRepositoryInterface;
    }

    public function index()
    {

        if (auth()->user()) {
            return view('confrontaCustomers.admin.form', [
                'notification' => 0,
            ]);
        } else {
            return view('confrontaCustomers.form', [
                'notification' => 0,
            ]);
        }
    }

    public function store(Request $request)
    {
        $numFormsToday = $this->confrontFormInterface->getCustomerConfrontFormLastDay($request->input('numberIdentification'));

        if ($numFormsToday >= 2) {
            if (auth()->user()) {
                return view('confrontaCustomers.admin.form', [
                    'notification' => 3,
                ]);
            } else {
                return view('confrontaCustomers.form', [
                    'notification' => 3,
                ]);
            }
        } else {
            $customer = $this->customerInterface->findCustomerByIdForConfronta($request->input('numberIdentification'));
            if ($customer) {
                if ($customer->FEC_EXP === $request->input('dateExpedition') && $customer->TIPO_DOC === $request->input('typeIdentification')) {

                    if (auth()->user()) {
                        return view('confrontaCustomers.admin.form_update', ['customer' => $customer, 'notification' => 0, 'login' => 1]);
                    } else {
                        return view('confrontaCustomers.form_update', ['customer' => $customer, 'notification' => 0, 'login' => 0]);
                    }
                } else {
                    if (auth()->user()) {
                        return view('confrontaCustomers.admin.form', [
                            'notification' => 1,
                        ]);
                    } else {
                        return view('confrontaCustomers.form', [
                            'notification' => 1,
                        ]);
                    }
                }
            } else {
                if (auth()->user()) {
                    return view('confrontaCustomers.admin.form', [
                        'notification' => 1,
                    ]);
                } else {
                    return view('confrontaCustomers.form', [
                        'notification' => 1,
                    ]);
                }
            }
        }
    }
    public function update(Request $request, $id)
    {
        // dd($request);

        // dd($request->customerData[0]['value']);
        // dd($request->customerData[1]['value']);

        $datas = [];
        foreach ($request->customerData as $key => $value) {
            $datas[$request->customerData[$key]['name']] = $request->customerData[$key]['value'];
        }
        $queryExistCel = DB::connection('oportudata')->select("SELECT COUNT(*) as total FROM `CLI_CEL` WHERE `IDENTI` = :cedula AND `NUM` = :telefono ", ['cedula' => $datas['CEDULA'], 'telefono' => $datas['CELULAR']]);
        if ($queryExistCel[0]->total == 0) {
            $clienteCelular          = new cliCel;
            $clienteCelular->IDENTI  = $datas['CEDULA'];
            $clienteCelular->NUM     = $datas['CELULAR'];
            $clienteCelular->TIPO    = 'CEL';
            $clienteCelular->CEL_VAL = 0;
            $clienteCelular->FECHA   = date("Y-m-d H:i:s");
            $clienteCelular->save();
        }
        $customer = $this->customerInterface->updateOrCreateCustomer($datas);

        $clienteCelular          = new cliCel;
        $clienteCelular->IDENTI  = $request->customerData[0]['value'];
        $clienteCelular->NUM     = $request->customerData[1]['value'];
        $clienteCelular->TIPO    = 'CEL';
        $clienteCelular->CEL_VAL = 1;
        $clienteCelular->FECHA   = date("Y-m-d H: i: s");
        $clienteCelular->save();

        dd($clienteCelular);

        return $customer;
    }
}