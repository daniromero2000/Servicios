<?php

namespace App\Http\Controllers\Admin;

use App\Imagenes;
use App\Lead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $images=Imagenes::all();
        return view('alogodvance.index',['images'=>$images, 'cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lead= new Lead;

        $lead->name=$request->get('name');
        $lead->lastName=$request->get('lastName');
        $lead->email=$request->get('email');
        $lead->telephone=$request->get('telephone');
        $lead->city=$request->get('city');
        $lead->typeService=$request->get('typeService');
        $lead->typeProduct=$request->get('typeProduct');
        $lead->channel=intval($request->get('channel'));
        $lead->termsAndConditions=$request->get('termsAndConditions');


        $lead->save();

        return redirect()->route('thankYouPageAvance');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
