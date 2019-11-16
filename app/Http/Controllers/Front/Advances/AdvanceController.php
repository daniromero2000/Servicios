<?php

namespace App\Http\Controllers\Front\Advances;

use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AdvanceController extends Controller
{
    private $leadInterface, $cityInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface
    ) {
        $this->leadInterface       = $leadRepositoryInterface;
        $this->cityInterface = $cityRepositoryInterface;
    }

    public function index()
    {

        $getIdcityUbi = $this->cityInterface->getCityByName('ABEJORRAL');

        $departament =   $getIdcityUbi->ID_DIAN;


        dd($departament);

        // $cityName = $this->getCity($request->get('city'));


        return view('advance.index', [
            'images' => Imagenes::selectRaw('*')->where('category', '=', '3')->where('isSlide', '=', '1')->get(),
            'cities' => $this->subsidiaryInterface->getAllSubsidiaryCityNames()
        ]);
    }

    private function getCity($code)
    {
        $queryCity = sprintf("SELECT `CIUDAD` FROM `SUCURSALES` WHERE `CODIGO` = %s ", $code);

        $resp = DB::connection('oportudata')->select($queryCity);

        return $resp;
    }


    public function store(Request $request)
    {
        $this->leadInterface->createLead($request->input());
        return redirect()->route('thankYouPageAvance');
    }
}
