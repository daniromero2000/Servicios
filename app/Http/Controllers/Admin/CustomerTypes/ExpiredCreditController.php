<?php

namespace App\Http\Controllers\Admin\CustomerTypes;

use Illuminate\Http\Request;
use App\ExpiredCredit;
use App\Http\Controllers\Controller;

class ExpiredCreditController extends Controller
{
    public function index(Request $request)
    {
        $identification = $request->get('identificationNumber');
       
        $expired=ExpiredCredit::identification($request->get('identificationNumber'))->orderBy('id','ASC')->paginate(10);

        return view ('expiredcredit.show')->with(compact('expired'));
    }

   public function show($identification)
   {
        $expiredcredit = ExpiredCredit::where('identificationNumber',$identification) -> first();
        return view ('show', compact('expired'));
    }
}

