<?php

namespace App\Http\Controllers\Admin\CustomerTypes;

use Illuminate\Http\Request;
use App\Summary;
use App\Http\Controllers\Controller;

class SummaryController extends Controller
{

    public function index(Request $request)
    { 
        $identification = $request->get('identificationNumber');
       
        $summary = Summary::identification($request->get('identificationNumber'))->orderBy('id','ASC')->paginate(2);

        return view ('summary.show')->with(compact('summary'));
    }

    public function show(Request $identificationNumber)
    {
        
    }
}
