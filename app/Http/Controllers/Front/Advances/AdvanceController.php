<?php

namespace App\Http\Controllers\Front\Advances;

use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;

class AdvanceController extends Controller
{
    private $leadInterface, $subsidiaryInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->leadInterface       = $leadRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->customerInterface = $customerRepositoryInterface;
    }

    public function index()
    {


        $dataOportudata = [
            'TIPO_DOC' => 'pruebaAlejo2',
            'CEDULA' => 'pruebaAlejo2',
            'NOMBRES' => 'pruebaAlejo2',
            'APELLIDOS' => 'pruebaAlejo2',
            'EMAIL' => 'pruebaAlejo2',
            'CELULAR' => 'pruebaAlejo2',
            'PROFESION' => 'NO APLICA',
            'ACTIVIDAD' => 'pruebaAlejo2',
            'CIUD_UBI' => 'pruebaAlejo2',
            'DEPTO' =>  'pruebaAlejo2',
            'FEC_EXP' => 'pruebaAlejo2',
            'TIPOCLIENTE' => 'OPORTUYA',
            'SUBTIPO' => 'WEB',
            'STATE' => 'A',
            'SUC' => 'pruebaAlejo2',
            'ESTADO' => 'pruebaAlejo2',
            'PASO' => 'pruebaAlejo2',
            'ORIGEN' => 'pruebaAlejo2',
            'CLIENTE_WEB' => 'pruebaAlejo2',
            'TRAT_DATOS' => "SI",
            'USUARIO_CREACION' => 'pruebaAlejo2',
            'USUARIO_ACTUALIZACION' => 'pruebaAlejo2',
            'FECHA_ACTUALIZACION' => date('Y-m-d H:i:s'),
            'ID_CIUD_UBI' => 'pruebaAlejo2',
            'MEDIO_PAGO' => 12,
        ];

        $this->customerInterface->createCustomer($dataOportudata);


        return view('advance.index', [
            'images' => Imagenes::selectRaw('*')->where('category', '=', '3')->where('isSlide', '=', '1')->get(),
            'cities' => $this->subsidiaryInterface->getAllSubsidiaryCityNames()
        ]);
    }

    public function store(Request $request)
    {
        $this->leadInterface->createLead($request->input());
        return redirect()->route('thankYouPageAvance');
    }
}
