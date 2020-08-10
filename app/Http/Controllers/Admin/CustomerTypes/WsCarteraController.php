<?php

namespace App\Http\Controllers\Admin\CustomerTypes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WsCarteraController extends Controller
{
  
  public function index(Request $request)
  { 
     return view ('customertype.wscartera.show');
  }

  public function wscartera(Request $identificationNumber)
     {                          
        $identificationNumber = $identificationNumber;
        set_time_limit(120);

        try{
        $ws = new \SoapClient("http://10.238.14.151:2818/Service1.svc?singleWsdl", array());
        $result = $ws->ConsultarOracle($identificationNumber);
        }catch (\Throwable $th) {
          return $th;
        }  
        return view('wscartera.show' , compact('result'));          
      }
}
