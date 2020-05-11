<?php

namespace App\Http\Controllers\Admin\Factors;

use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class FactorController extends Controller
{

    private $factorInterface;

    public function __construct(
        FactorRepositoryInterface $factorRepositoryInterface
    ) {
        $this->factorInterface = $factorRepositoryInterface;
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $factors = $this->factorInterface->getAllFactors();
        return response()->json($factors);
    }

    public function store(Request $request)
    {
        // dd($request->input());
        $data = $request->input();
        $data['creation_user_id'] = auth()->user()->id;
        // dd($data);

        $factor =  $this->factorInterface->createFactor($data);
        return $factor;
        // dd($factor);
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        $factor =  $this->factorInterface->updateFactor($data);

        return response()->json($factor);
    }

    public function destroy($id)
    {
        $factor =  $this->factorInterface->deleteFactor($id);
        return response()->json($factor);
    }
}