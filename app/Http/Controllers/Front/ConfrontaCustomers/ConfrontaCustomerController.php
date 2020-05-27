<?php

namespace App\Http\Controllers\Front\ConfrontaCustomers;

use App\cliCel;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
use App\Entities\ConfrontForms\Repositories\Interfaces\ConfrontFormRepositoryInterface;
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
        $this->confrontFormInterface      = $confrontFormRepositoryInterface;
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

        $datas = [];
        foreach ($request->customerData as $key => $value) {
            $datas[$request->customerData[$key]['name']] = $request->customerData[$key]['value'];
        }
        $queryExistCel = DB::connection('oportudata')->select("SELECT COUNT(*) as total FROM `CLI_CEL` WHERE `IDENTI` = :cedula AND `NUM` = :telefono ", ['cedula' => $datas['CEDULA'], 'telefono' => $datas['CELULAR']]);
        if ($queryExistCel[0]->total == 0) {
            $dataCliCel = ['IDENTI' => $datas['CEDULA'], 'NUM' => $datas['CELULAR'], 'TIPO' => 'CEL', 'CEL_VAL' => '0', 'FECHA' => date("Y-m-d H:i:s")];
            $customer = cliCel::create($dataCliCel);
        }
        $customer = $this->customerInterface->updateOrCreateCustomer($datas);

        return $customer;
    }
}