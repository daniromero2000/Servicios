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

        $listGiveAway =  $this->listGiveAwayInterface->createlistGiveAway($data);
        return response()->json($listGiveAway);
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        $listGiveAway =  $this->listGiveAwayInterface->updateListGiveAway($data);

        return response()->json($listGiveAway);
    }

    public function destroy($id)
    {
        $listGiveAway =  $this->listGiveAwayInterface->deleteListGiveAway($id);

        return response()->json($listGiveAway);
    }
}
