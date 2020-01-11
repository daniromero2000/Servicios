<?php

namespace App\Http\Controllers\Front\Motos;

use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;

class MotosController extends Controller
{
    private $leadInterface, $subsidiaryInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
    ) {
        $this->leadInterface       = $leadRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
    }

    public function index()
    {
        return view('motos.index', [
            'images' => Imagenes::all(),
            'cities' => $this->subsidiaryInterface->getAllSubsidiaryCityNames()
        ]);
    }

    public function store(Request $request)
    {
        $lead = $this->leadInterface->createLead($request->input());
        $lead->leadStatus()->attach(8, ['user_id' => 641]);

        return redirect()->route('thankYouPageMotos');
    }
}
