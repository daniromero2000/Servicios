<?php

namespace App\Http\Controllers\Admin\ListGiveAways;

use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ListGiveAwayController extends Controller
{

    private $listGiveAwayInterface;

    public function __construct(
        ListGiveAwayRepositoryInterface $listGiveAwayRepositoryInterface
    ) {
        $this->listGiveAwayInterface = $listGiveAwayRepositoryInterface;
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $listGiveAways = $this->listGiveAwayInterface->getAlllistGiveAways();
        return response()->json($listGiveAways);
    }

    public function store(Request $request)
    {
        // dd($request->input());
        $data = $request->input();
        $data['creation_user_id'] = auth()->user()->id;
        dd($data);

        $listGiveAway =  $this->listGiveAwayInterface->createlistGiveAway($data);
        dd($listGiveAway);
    }
}
