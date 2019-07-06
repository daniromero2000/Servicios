<?php

namespace App\Http\Controllers\Admin;

use App\Assessor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class assessorsController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:assessor']);
    }
/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('assessors.dashboard');
    }


    public function step1(){
        $cities = [
            [ 'label' => 'ARMENIA', 'value' => 'ARMENIA' ],
            [ 'label' => 'MANIZALES', 'value' => 'MANIZALES' ],
            [ 'label' => 'SINCELEJO', 'value' => 'SINCELEJO' ],
            [ 'label' => 'YOPAL', 'value' => 'YOPAL' ],
            [ 'label' => 'CERETÉ', 'value' => 'CERETÉ' ],
            [ 'label' => 'TULUÁ', 'value' => 'TULUÁ' ],
            [ 'label' => 'ACACÍAS', 'value' => 'ACACÍAS' ],
            [ 'label' => 'ESPINAL', 'value' => 'ESPINAL' ],
            [ 'label' => 'MARIQUITA', 'value' => 'MARIQUITA' ],
            [ 'label' => 'CARTAGENA', 'value' => 'CARTAGENA' ],
            [ 'label' => 'LA DORADA', 'value' => 'LA DORADA' ],
            [ 'label' => 'IBAGUÉ', 'value' => 'IBAGUÉ' ],
            [ 'label' => 'MONTERÍA', 'value' => 'MONTERÍA' ],
            [ 'label' => 'MAGANGUÉ', 'value' => 'MAGANGUÉ' ],
            [ 'label' => 'PEREIRA', 'value' => 'PEREIRA' ],
            [ 'label' => 'CALI', 'value' => 'CALI' ],
            [ 'label' => 'MONTELIBANO', 'value' => 'MONTELIBANO' ],
            [ 'label' => 'SAHAGÚN', 'value' => 'SAHAGÚN' ],
            [ 'label' => 'PLANETA RICA', 'value' => 'PLANETA RICA' ],
            [ 'label' => 'COROZAL', 'value' => 'COROZAL' ],
            [ 'label' => 'CIÉNAGA', 'value' => 'CIÉNAGA' ],
            [ 'label' => 'MONTELÍ', 'value' => 'MONTELÍ' ],
            [ 'label' => 'PLATO', 'value' => 'PLATO' ],
            [ 'label' => 'SABANALARGA', 'value' => 'SABANALARGA' ],
            [ 'label' => 'GRANADA', 'value' => 'GRANADA' ],
            [ 'label' => 'PUERTO BERRÍ', 'value' => 'PUERTO BERRÍ' ],
            [ 'label' => 'VILLAVICENCIO', 'value' => 'VILLAVICENCIO' ],
            [ 'label' => 'TAURAMENA', 'value' => 'TAURAMENA' ],
            [ 'label' => 'PUERTO GAITÁN', 'value' => 'PUERTO GAITÁN' ],
            [ 'label' => 'PUERTO BOYACÁ', 'value' => 'PUERTO BOYACÁ' ],
            [ 'label' => 'PUERTO LÓPEZ', 'value' => 'PUERTO LÓPEZ' ],
            [ 'label' => 'SEVILLA', 'value' => 'SEVILLA' ],
            [ 'label' => 'CHINCHINÁ', 'value' => 'CHINCHINÁ' ],
            [ 'label' => 'AGUACHICA', 'value' => 'AGUACHICA' ],
            [ 'label' => 'BARRANCABERMEJA', 'value' => 'BARRANCABERMEJA' ],
            [ 'label' => 'LA VIRGINIA', 'value' => 'LA VIRGINIA' ],
            [ 'label' => 'SANTA ROSA DE CABAL', 'value' => 'SANTA ROSA DE CABAL' ],
            [ 'label' => 'GIRARDOT', 'value' => 'GIRARDOT' ],
            [ 'label' => 'VILLANUEVA', 'value' => 'VILLANUEVA' ],
            [ 'label' => 'PITALITO', 'value' => 'PITALITO' ],
            [ 'label' => 'GARZÓN', 'value' => 'GARZÓN' ],
            [ 'label' => 'NEIVA', 'value' => 'NEIVA' ],
            [ 'label' => 'LORICA', 'value' => 'LORICA' ],
            [ 'label' => 'AGUAZUL',  'value' => 'AGUAZUL']
        ];
        $digitalAnalyst = [['name' => 'Mariana', 'img' => 'images/analista3.png']];
        //return $cities;
        return view('oportuya.step1', ['digitalAnalyst' => $digitalAnalyst[0], 'cities' => array_sort($cities, 'label', SORT_DESC)]);
    }

    public function step2($string){
        $identificactionNumber = $this->decrypt($string);

        return view('oportuya.step2', ['identificactionNumber' => $identificactionNumber]);
    }

    public function step3($string){
        $identificactionNumber = $this->decrypt($string);

        return view('oportuya.step3', ['identificactionNumber' => $identificactionNumber]);
    }

    public function encrypt($string) {
        $string = utf8_encode($string);
        $control1 = "*]wy";
        $control2 = "3/~";
        $string = $control1.$string.$control2;
        $string = base64_encode($string);

        return $string;
    } 

    public function decrypt($string){
        $string = $string; 
        $string = base64_decode($string); 
        $controls = ['*]wy', '3/~']; 
        $replaces = ['', ''];
        $string = str_replace($controls, $replaces, $string); 

        return $string;
    }

    public function getFormVentaContado(){
        if(Auth::guard('assessor')->check()){
            return view('assessors.forms.ventaContado');
        }else{
            return view('assessors.login');
        }
    }
}
