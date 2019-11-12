<?php

namespace App\Http\Controllers\Admin;

use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;

class MotosController extends Controller
{
    private $leadInterface;

    public function __construct(LeadRepositoryInterface $leadRepositoryInterface)
    {
        $this->leadInterface = $leadRepositoryInterface;
    }

    public function index()
    {
        $cities = [
            ['label' => 'ARMENIA', 'value' => 'ARMENIA'],
            ['label' => 'MANIZALES', 'value' => 'MANIZALES'],
            ['label' => 'SINCELEJO', 'value' => 'SINCELEJO'],
            ['label' => 'YOPAL', 'value' => 'YOPAL'],
            ['label' => 'CERETÉ', 'value' => 'CERETÉ'],
            ['label' => 'TULUÁ', 'value' => 'TULUÁ'],
            ['label' => 'ACACÍAS', 'value' => 'ACACÍAS'],
            ['label' => 'ESPINAL', 'value' => 'ESPINAL'],
            ['label' => 'MARIQUITA', 'value' => 'MARIQUITA'],
            ['label' => 'CARTAGENA', 'value' => 'CARTAGENA'],
            ['label' => 'LA DORADA', 'value' => 'LA DORADA'],
            ['label' => 'IBAGUÉ', 'value' => 'IBAGUÉ'],
            ['label' => 'MONTERÍA', 'value' => 'MONTERÍA'],
            ['label' => 'MAGANGUÉ', 'value' => 'MAGANGUÉ'],
            ['label' => 'PEREIRA', 'value' => 'PEREIRA'],
            ['label' => 'CALI', 'value' => 'CALI'],
            ['label' => 'MONTELIBANO', 'value' => 'MONTELIBANO'],
            ['label' => 'SAHAGÚN', 'value' => 'SAHAGÚN'],
            ['label' => 'PLANETA RICA', 'value' => 'PLANETA RICA'],
            ['label' => 'COROZAL', 'value' => 'COROZAL'],
            ['label' => 'CIÉNAGA', 'value' => 'CIÉNAGA'],
            ['label' => 'MONTELÍ', 'value' => 'MONTELÍ'],
            ['label' => 'PLATO', 'value' => 'PLATO'],
            ['label' => 'SABANALARGA', 'value' => 'SABANALARGA'],
            ['label' => 'GRANADA', 'value' => 'GRANADA'],
            ['label' => 'PUERTO BERRÍ', 'value' => 'PUERTO BERRÍ'],
            ['label' => 'VILLAVICENCIO', 'value' => 'VILLAVICENCIO'],
            ['label' => 'TAURAMENA', 'value' => 'TAURAMENA'],
            ['label' => 'PUERTO GAITÁN', 'value' => 'PUERTO GAITÁN'],
            ['label' => 'PUERTO BOYACÁ', 'value' => 'PUERTO BOYACÁ'],
            ['label' => 'PUERTO LÓPEZ', 'value' => 'PUERTO LÓPEZ'],
            ['label' => 'SEVILLA', 'value' => 'SEVILLA'],
            ['label' => 'CHINCHINÁ', 'value' => 'CHINCHINÁ'],
            ['label' => 'AGUACHICA', 'value' => 'AGUACHICA'],
            ['label' => 'BARRANCABERMEJA', 'value' => 'BARRANCABERMEJA'],
            ['label' => 'LA VIRGINIA', 'value' => 'LA VIRGINIA'],
            ['label' => 'SANTA ROSA DE CABAL', 'value' => 'SANTA ROSA DE CABAL'],
            ['label' => 'GIRARDOT', 'value' => 'GIRARDOT'],
            ['label' => 'VILLANUEVA', 'value' => 'VILLANUEVA'],
            ['label' => 'PITALITO', 'value' => 'PITALITO'],
            ['label' => 'GARZÓN', 'value' => 'GARZÓN'],
            ['label' => 'NEIVA', 'value' => 'NEIVA'],
            ['label' => 'LORICA', 'value' => 'LORICA'],
            ['label' => 'AGUAZUL',  'value' => 'AGUAZUL']
        ];

        return view('motos.index', [
            'images' => Imagenes::all(),
            'cities' => $cities
        ]);
    }

    public function store(Request $request)
    {
        $this->leadInterface->createLead($request->input());

        return redirect()->route('thankYouPageMotos');
    }
}
