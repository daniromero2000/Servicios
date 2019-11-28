<?php

namespace App\Http\Controllers\Admin\Intentions;

use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Intentions\Repositories\IntentionRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

class IntentionController extends Controller
{
    private $intentionInterface, $toolsInterface;

    public function __construct(
        IntentionRepositoryInterface $intentionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->intentionInterface->listIntentions($skip * 30);

        if (request()->has('q')) {
            $list = $this->intentionInterface->searchIntentions(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('status'))->sortByDesc('SOLICITUD');
        }

        //dd
        $listCount = $list->count();

        return view('intentions.list', [
            'intentions'            => $list,
            'optionsRoutes'        => (request()->segment(1)),
            'headers'              => ['Intención', 'Cliente', 'Fecha', 'Definición', 'Tipo CLiente', 'Obligaciones', 'Perfil Crediticio', 'Historial Crediticio', 'Crédito', 'Zona', 'Edad', 'Tiempo en Labor', 'Tipo 5', 'Inspección Ocular', 'Estado'],
            'listCount'            => $listCount,
            'skip'                 => $skip,
        ]);
    }

    public function show(int $id)
    {
        // $customer = $this->intentionInterface->findFactoryRequestByIdFull($id);

        return view('Intentions.show');
    }

    public function assignAssesorDigitalToLead($solicitud)
    { }

    public function dashboard(Request $request)
    {

        return view('Intentions.dashboard');
    }
}
