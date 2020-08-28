<?php

namespace App\Http\Controllers\Admin\CustomerTypes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WsCarteraController extends Controller
{
  public function wscartera(Request $identificationNumber)
     {                
        $idNumber = ($identificationNumber -> input('identificationNumber'));

        $identificationNumber = $identificationNumber;

        try{
        $ws = new \SoapClient("http://10.238.14.151:2818/Service1.svc?singleWsdl", array());
        $result = $ws->ConsultarOracle($identificationNumber);
        }catch (\Throwable $th) {
          return $th;
        }  
       
        return redirect()->action('Admin\CustomerTypes\CurrentCreditController@show', ['identificationNumber' => $idNumber]);
     }
}
