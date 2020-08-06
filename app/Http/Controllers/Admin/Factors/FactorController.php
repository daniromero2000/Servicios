<?php

namespace App\Http\Controllers\Admin\Factors;

use App\Entities\FactorsOportudata\Repositories\Interfaces\FactorsOportudataRepositoryInterface;
use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class FactorController extends Controller
{

    private $factorInterface, $factorOportudataInterface;

    public function __construct(
        FactorRepositoryInterface $factorRepositoryInterface,
        FactorsOportudataRepositoryInterface $factorsOportudataRepositoryInterface

    ) {
        $this->factorInterface = $factorRepositoryInterface;
        $this->factorOportudataInterface = $factorsOportudataRepositoryInterface;
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $factors = $this->factorInterface->getAllFactors();
        return response()->json($factors);
    }

    public function getFactors(Request $request)
    {
        $factors = $this->factorInterface->getFactorsForLiquidator();
        return response()->json($factors);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $data['creation_user_id'] = auth()->user()->id;

        $factor =  $this->factorInterface->createFactor($data);
        return $factor;
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        // calculo de los factores de las cuotas;
        if ($data['id'] == 1) {
            $value = $data['value'] / 100;
            for ($i = 1; $i <= 24; $i++) {
                $share = 0;
                $share = round((($value * (1 + $value) ** $i) * 100 / (((1 + $value) ** $i) - 1)) / 100, 5);
                $factorOportudata[] = ['CUOTA'  => $i, 'FACTOR' => $share];
            }
            $factors = $this->factorOportudataInterface->updateFactorsOportudata($factorOportudata);
        }

        $factor =  $this->factorInterface->updateFactor($data);

        return response()->json($factor);
    }

    public function destroy($id)
    {
        $factor =  $this->factorInterface->deleteFactor($id);
        return response()->json($factor);
    }
}