<?php

/**
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DE PRODUCTOS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador REST para la administracion de  lineas.
    ** todos los metodos se dividen en dos partes consulta a BD y respuesta en json
    **Fecha: 19/12/2018
     **/

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Line;


class LinesController extends Controller
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
        
          //query 
        if($request->delete=="true"){
            $lines = DB::table('lines')
                    ->select('name','id')
                    ->where('name','LIKE','%' . $request->q . '%')
                    ->where('deleted_at', '<>' , null)
                    ->orderBy('id', 'desc')
                    ->skip($request->page*($request->actual-1))
                    ->take($request->page)
                    ->get();
        }else{
            $lines = DB::table('lines')
                    ->select('name','id')
                    ->where('name','LIKE','%' . $request->q . '%')
                    ->whereNull("deleted_at")
                    ->orderBy('id', 'desc')
                    ->skip($request->page*($request->actual-1))
                    ->take($request->page)
                    ->get();
        }
        //respuesta en json
        return response()->json($lines);
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
        try {
             //consulta
            $lines = new Line;
            $lines->name = $request->name;
            $lines->save();
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
             //quey 
            $lines = Line::find($id);
            $lines->name = $request->name;
            $lines->save();
            return response()->json(true);

        }
        // if resource already exist return error
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
        //query
        $lines = Line::findOrFail($id);
        $lines->delete();
        // json respons
        return response()->json([true]);
    }
}
