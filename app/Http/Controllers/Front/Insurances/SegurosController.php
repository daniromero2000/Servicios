<?php

namespace App\Http\Controllers\Front\Insurances;

use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;

class SegurosController extends Controller
{
    private $leadInterface, $subsidiaryInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
    ) {
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->leadInterface       = $leadRepositoryInterface;
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
        $this->leadInterface->createLead($request->input());

        return redirect()->route('thankYouPageSeguros');
    }
}
