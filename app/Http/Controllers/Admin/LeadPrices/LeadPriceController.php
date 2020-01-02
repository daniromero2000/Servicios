<?php

namespace App\Http\Controllers\Admin\LeadPrices;

use App\Entities\LeadPrices\Repositories\Interfaces\LeadPriceRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadPriceController extends Controller
{
    private $LeadPriceInterface;

    public function __construct(
        LeadPriceRepositoryInterface $LeadPriceRepositoryInterface
    ) {
        $this->LeadPriceInterface = $LeadPriceRepositoryInterface;
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        return $this->LeadPriceInterface->createLeadPrice($request->input());

        return response()->json([true]);
    }
}
