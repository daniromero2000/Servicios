<?php

namespace App\Http\Controllers\Admin\CustomerTypes;

use Illuminate\Http\Request;
use App\CustomerType;
use App\Http\Controllers\Controller;

class CustomerTypeController extends Controller
{
    public function index(Request $request)
    {
        $identification = $request->get('identificationNumber');
       
        $customer=CustomerType::identification($request->get('identificationNumber'))->orderBy('id','ASC')->paginate(2);

        return view ('customertype.show')->with(compact('customer'));
    }

   public function show($identification)
   {
        $customertype = CustomerType::where('identificationNumber',$identification) -> first();
        return view ('show', compact('customertype'));
    }
}