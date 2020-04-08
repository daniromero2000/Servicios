<?php

namespace App\Http\Controllers\Admin;

use App\Entities\ConfrontForms\Repositories\Interfaces\ConfrontFormRepositoryInterface;
use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;

class OportuyaController extends Controller
{
    private $leadInterface, $subsidiaryInterface;
    private $formInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        ConfrontFormRepositoryInterface $confrontFormRepositoryInterface
    ) {
        $this->leadInterface       = $leadRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->formInterface       = $confrontFormRepositoryInterface;
    }

    public function index()
    {
        $images = Imagenes::selectRaw('*')
            ->where('category', '=', '1')
            ->where('isSlide', '=', '1')
            ->get();

        return view('oportuya.index', [
            'images' => $images,
            'cities' => $this->subsidiaryInterface->getAllSubsidiaryCityNames()
        ]);
    }

    public function store(Request $request)
    {
        $this->leadInterface->createLead($request->input());

        return redirect()->route('thankYouPageOportuya');
    }
}
