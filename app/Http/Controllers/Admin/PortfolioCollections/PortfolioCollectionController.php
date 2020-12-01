<?php

namespace App\Http\Controllers\Admin\PortfolioCollections;

use App\Entities\PortfolioCollections\Repositories\Interfaces\PortfolioCollectionRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioCollectionController extends Controller
{
    private $PortfolioCollectionInterface;

    public function __construct(
        PortfolioCollectionRepositoryInterface $PortfolioCollectionRepositoryInterface
    ) {
        $this->PortfolioCollectionInterface = $PortfolioCollectionRepositoryInterface;
        // $this->middleware('auth');
    }
    public function index()
    {
        return view('portfoliocollection::index');
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
       
    }
}
