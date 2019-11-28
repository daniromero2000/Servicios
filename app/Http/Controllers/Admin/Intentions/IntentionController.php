<?php

namespace App\Http\Controllers\Admin\Intentions;

use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\Intentions\Repositories\IntentionRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IntentionController extends Controller
{
    private $intentionInterface, $toolsInterface;

    public function __construct(
        IntentionRepositoryInterface $intentionRepositoryInterface
    ) {
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // $skip = $this->toolsInterface->getSkip($request->input('skip'));
        // $list = $this->intentionInterface->listIntention($skip * 30);

        // if (request()->has('q')) {
        // }

        // $listCount = $list->count();
        // $factoryRequestsTotal = $list->sum('GRAN_TOTAL');

        return view('Intentions.list');
    }

    public function show(int $id)
    {
        // $customer = $this->intentionInterface->findFactoryRequestByIdFull($id);

        return view('Intentions.show');
    }

    public function assignAssesorDigitalToLead($solicitud)
    {
    }

    public function dashboard(Request $request)
    {
       
        return view('Intentions.dashboard');
    }
}
