<?php

namespace App\Http\Controllers\Admin\CustomerTypes;

use App\PaymentTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $identification = $request->get('identificationNumber');
       
        $payment=PaymentTime::identification($request->get('identificationNumber'))->orderBy('id','ASC')->paginate(10);

        return view ('payment.show')->with(compact('payment'));
    }   
}
