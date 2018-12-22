<?php

/**
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DE PRODUCTOS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador REST para la administracion de Perfiles por ciudad.
    ** todos los metodos se dividen en dos partes consulta a BD y respuesta en json
    **Fecha: 21/12/2018
     **/

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\ProfilesCity;



class ProfilesCitiesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          //consulta
        if($request->delete=="true"){
            $profilesCity = DB::table('profiles_cities')
                    ->select('name','id')
                    ->where('name','LIKE','%' . $request->q . '%')
                    ->where('deleted_at', '<>' , null)
                    ->orderBy('id', 'desc')
                    ->skip($request->page*($request->actual-1))
                    ->take($request->page)
                    ->get();
        }else{
            $profilesCity = DB::table('profiles_cities')
                    ->select('name','id')
                    ->where('name','LIKE','%' . $request->q . '%')
                    ->whereNull("deleted_at")
                    ->orderBy('id', 'desc')
                    ->skip($request->page*($request->actual-1))
                    ->take($request->page)
                    ->get();
        }
        //respuesta en json
        return response()->json($profilesCity);
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
        //Exception handling
        try {
             //consulta
            $profilesCities = new ProfilesCity;
            $profilesCities->name = $request->name;
            $profilesCities->save();
            //resoupuesta
            return response()->json(true);

        }
        catch(\Exception $e) {
            if ($e->getCode()=="23000"){
                return response()->json($e->getCode());
            }else{
                return response()->json($e->getMessage());
            }
        }
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
        try {
             //consulta
            $profilesCities = ProfilesCity::find($id);
            $profilesCities->name = $request->name;
            $profilesCities->save();
            return response()->json(true);

        }
        catch(\Exception $e) {
            if ($e->getCode()=="23000"){
                return response()->json($e->getCode());
            }else{
                return response()->json($e->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //consulta
        $lines = profilesCity::findOrFail($id);
        $lines->delete();
        //respuesta en json
        return response()->json([true]);
    }
}
