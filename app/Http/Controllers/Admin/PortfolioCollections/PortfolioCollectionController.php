<?php

namespace App\Http\Controllers\Admin\PortfolioCollections;

use App\Entities\PortfolioCollections\Repositories\Interfaces\PortfolioCollectionRepositoryInterface;
use App\Entities\PortfolioCollectionTokens\Repositories\Interfaces\PortfolioCollectionTokenRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioCollectionController extends Controller
{
    private $portfolioCollectionInterface, $portfolioCollectionTokenInterface;

    public function __construct(
        PortfolioCollectionRepositoryInterface $PortfolioCollectionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        PortfolioCollectionTokenRepositoryInterface $portfolioCollectionTokenRepositoryInterface
    ) {
        $this->portfolioCollectionInterface = $PortfolioCollectionRepositoryInterface;
        $this->portfolioCollectionTokenInterface = $portfolioCollectionTokenRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $list = $this->portfolioCollectionInterface->listPortfolioCollection();
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        return view('portfoliocollections.index', [
            'portfolioCollections'  => $list,
            'skip'                  => $skip,
            'optionsRoutes'         => (request()->segment(2)),
            'headers'               => ['Cliente', 'Asesor', 'Monto', 'Referencia', 'Estado',  'Fecha']
        ]);
    }

    public function create()
    {
        return view('portfoliocollections.create');
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $token = $this->portfolioCollectionTokenInterface->getPortfolioCollectionToken();
        $status = 0;
        try {
            $response = $this->portfolioCollectionInterface->sendPortfolioCollection(['token' => $token->token, 'payment_reference' => $request->input('payment_reference'), 'amount' => $request->input('amount'), 'payment_date' => $request->input('payment_date')]);
            $response = json_decode($response, TRUE);
            $response['SpResult'] = json_decode($response['SpResult'], TRUE);
            if (array_key_exists('Code', $response['SpResult'][0])) {
                if ($response['SpResult'][0]['Code'] == 400) {
                    $status = 2;
                } else {
                    $status = 1;
                }
            }else{
                $status = 1;
            }
            
        } catch (\Throwable $th) {
            return $th->getMessage();
            $status = 2;
        }
        $data['user_id'] = auth()->user()->email;
        $data['subsidiary_id'] = auth()->user()->Assessor->SUCURSAL;
        $data['status'] = $status;
        $this->portfolioCollectionInterface->createPortfolioCollection($data);

        // $request->session()->flash('message', 'Creación exitosa!');
        return redirect()->route('portfolioCollections.index');
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
