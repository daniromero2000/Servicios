<?php

namespace App\Http\Controllers\Admin;

use App\Imagenes;
use App\Viajes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;

class ViajesController extends Controller
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
        $plans = Viajes::selectRaw('imagenes.img,viajes.destination,viajes.beginDate,viajes.endingDate,viajes.isLocal,viajes.price,viajes.description,viajes.textButton')
            ->leftjoin('imagenes', 'viajes.idImg', '=', 'imagenes.id')
            ->where('imagenes.category', '=', '2')
            ->where('imagenes.isSlide', '=', '0')
            ->orderBy('viajes.id')->get();

        $imagesViajes = Imagenes::selectRaw('*')
            ->where('category', '=', '2')
            ->where('isSlide', '=', '1')
            ->get();

        return view('viajes.index', [
            'images'       => Imagenes::all(),
            'cities'       => $this->subsidiaryInterface->getAllSubsidiaryCityNames(),
            'imagesViajes' => $imagesViajes,
            'plans'        => $plans
        ]);
    }

    public function create()
    { }

    public function store(Request $request)
    {
        $this->leadInterface->createLead($request->input());

        return redirect()->route('thankYouPageViajes');
    }
}
