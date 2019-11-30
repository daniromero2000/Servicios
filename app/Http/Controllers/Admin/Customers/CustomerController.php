<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

class CustomerController extends Controller
{
    private $CustomerInterface, $toolsInterface;

    public function __construct(
        CustomerRepositoryInterface $CustomerRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->CustomerInterface = $CustomerRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->CustomerInterface->listCustomers($skip * 30);

        if (request()->has('q')) {
            $list = $this->CustomerInterface->searchCustomers(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'))->sortByDesc('FECHA_INTENCION');
        }
        $listCount = $list->count();


        return view('customers.list', [
            'customers'            => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['Cedula', 'Apellido', 'Nombre', 'Actividad', 'Estado Obligaciones', 'Score', 'Perfil Crediticio', 'Historial Crediticio', 'Crédito', 'Riesgo Zona', 'Edad', 'Tiempo en Labor', 'Tipo 5 Especial', 'Inspección Ocular', 'Estado Cliente', 'Definición'],
            'listCount'            => $listCount,
            'skip'                 => $skip,
        ]);
    }

    public function show(int $id)
    {
        $Customer = $this->CustomerInterface->findCustomerByIdFull($id);

        return view('customers.show', [
            'Customer' =>  $Customer
        ]);
    }

    public function assignAssesorDigitalToLead($solicitud)
    { }

    public function dashboard(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->subMonth();

        $creditProfiles = $this->CustomerInterface->countCustomersCreditProfiles($from, $to);
        $creditCards = $this->CustomerInterface->countCustomersCreditCards($from, $to);

        if (request()->has('from')) {
            $creditProfiles = $this->CustomerInterface->countCustomersCreditProfiles(request()->input('from'), request()->input('to'));
            $creditCards = $this->CustomerInterface->countCustomersCreditCards(request()->input('from'), request()->input('to'));
        }

        $creditProfiles   = $creditProfiles->toArray();
        $creditProfiles   = array_values($creditProfiles);
        $creditCards   = $creditCards->toArray();
        $creditCards   = array_values($creditCards);

        $creditProfilesNames  = [];
        $creditProfilesValues  = [];

        foreach ($creditProfiles as $creditProfile) {
            array_push($creditProfilesNames, trim($creditProfile['PERFIL_CREDITICIO']));
            array_push($creditProfilesValues, trim($creditProfile['total']));
        }


        return view('customers.dashboard', [
            'creditProfilesNames'  => $creditProfilesNames,
            'creditProfilesValues' => $creditProfilesValues,
            'creditCards'  => $creditCards,
            'totalStatuses'  => array_sum($creditProfilesValues),
        ]);
    }
}
