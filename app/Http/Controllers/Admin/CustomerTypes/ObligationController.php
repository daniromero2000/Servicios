<?php

namespace App\Http\Controllers\Admin\CustomerTypes;

use App\Obligation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ObligationController extends Controller
{
    public function index(Request $request)
    { 
        $identification = $request->get('identificationNumber');
       
        $obligations = Obligation::identification($request->get('identificationNumber'))->orderBy('id','ASC')->paginate(25);

        return view ('obligation.show')->with(compact('obligations'));
    }

    public function show(Request $request)
    {
        $identification = $request->get('identificationNumber');

        $credit = Obligation::identification($request->get('identificationNumber'))->orderBy('id','ASC')->first();
        return ('credit');
    }    
}
