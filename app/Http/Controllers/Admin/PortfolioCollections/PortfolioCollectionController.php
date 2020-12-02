<?php

namespace App\Http\Controllers\Admin\PortfolioCollections;

use App\Entities\PortfolioCollections\Repositories\Interfaces\PortfolioCollectionRepositoryInterface;
use App\Entities\PortfolioCollectionTokens\Repositories\Interfaces\PortfolioCollectionTokenRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioCollectionController extends Controller
{
    private $portfolioCollectionInterface, $portfolioCollectionTokenInterface;

    public function __construct(
        PortfolioCollectionRepositoryInterface $PortfolioCollectionRepositoryInterface,
        PortfolioCollectionTokenRepositoryInterface $portfolioCollectionTokenRepositoryInterface
    ) {
        $this->portfolioCollectionInterface = $PortfolioCollectionRepositoryInterface;
        $this->portfolioCollectionTokenInterface = $portfolioCollectionTokenRepositoryInterface;
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        return view('portfoliocollections.index');
    }

    public function store(Request $request)
    {        
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

    public function test(Request $request)
    {
        $token = $this->portfolioCollectionTokenInterface->getPortfolioCollectionToken();
        
        return $this->portfolioCollectionInterface->sendPortfolioCollection(['token' => $token->token]);
    }
}
