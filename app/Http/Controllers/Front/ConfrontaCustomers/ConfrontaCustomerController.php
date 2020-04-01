<?php

namespace App\Http\Controllers\Front\ConfrontaCustomers;

use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\CustomerCellPhones\Repositories\Interfaces\CustomerCellPhoneRepositoryInterface;
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
        CityRepositoryInterface $cityRepositoryInterface
    ) {
        $this->subsidiaryInterface        = $subsidiaryRepositoryInterface;
        $this->customerInterface          = $customerRepositoryInterface;
        $this->customerCellPhoneInterface = $customerCellPhoneRepositoryInterface;
        $this->cityInterface              = $cityRepositoryInterface;
    }

    public function index()
    {
        return view('confrontaCustomers.form', [
            'notification' => 0,
        ]);
    }

    public function store(Request $request)
    {
        $customer = $this->customerInterface->findCustomerByIdForConfronta($request->input('numberIdentification'));
        if ($customer) {
            if ($customer->FEC_EXP === $request->input('dateExpedition') && $customer->TIPO_DOC === $request->input('typeIdentification')) {
                return view('confrontaCustomers.form_update', ['customer' => $customer]);
            } else {
                return view('confrontaCustomers.form', [
                    'notification' => 1,
                ]);
            }
        } else {
            return view('confrontaCustomers.form', [
                'notification' => 1,
            ]);
        }
    }
    public function show()
    {
        return;
    }

    public function getInfoForm()
    {
    }
}