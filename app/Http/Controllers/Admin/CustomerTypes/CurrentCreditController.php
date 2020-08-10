<?php

namespace App\Http\Controllers\Admin\CustomerTypes;

use Illuminate\Http\Request;
use App\CurrentCredit;
use App\Http\Controllers\Controller;

class CurrentCreditController extends Controller
{
    public function index(Request $request)
    {
        $identification = $request->get('identificationNumber');
       
        $current=CurrentCredit::identification($request->get('identificationNumber'))->orderBy('id','ASC')->paginate(10);

        return view ('currentcredit.show')->with(compact('current'));
    }

    public function show(CurrentCredit $current)
    {
        return view ('currentcredit.show', compact('current'));
    }   
}