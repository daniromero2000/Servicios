<?php

/**
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DE PRODUCTOS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador REST para la administracion de productos, marcas y lineas.
    ** todos los metodos se dividen en dos partes consulta a BD y respuesta en json
    **Fecha: 13/12/2018
     **/

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Brand;


class BrandsController extends Controller
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
            $brands = DB::table('brands')
                    ->select('name','id')
                    ->where('name','LIKE','%' . $request->q . '%')
                    ->where('deleted_at', '<>' , null)
                    ->orderBy('id', 'desc')
                    ->skip($request->page*($request->actual-1))
                    ->take($request->page)
                    ->get();
        }else{
            $brands = DB::table('brands')
                    ->select('name','id')
                    ->where('name','LIKE','%' . $request->q . '%')
                    ->whereNull("deleted_at")
                    ->orderBy('id', 'desc')
                    ->skip($request->page*($request->actual-1))
                    ->take($request->page)
                    ->get();
        }
        //respuesta en json
        return response()->json($brands);
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
     suma(4,7);
     */
    public function store(Request $request){ 
        try {
             //consulta
            $brands = new Brand;
            $brands->name = $request->name;
            $brands->id_user = Auth::id();
            
            $brands->save();
        
            return response()->json(true);

        }
        catch(\Exception $e) {
            if ($e->getCode()=="23000"){
                return response()->json($e->getCode());
            }else{
                return response()->json("indeterminate error");
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
            $brands =  Brand::find($id);
            $brands->name = $request->name;        
            $brands->save();
        
            return response()->json(true);
        }
        catch(\Exception $e) {
            if ($e->getCode()=="23000"){
                return response()->json($e->getCode());
            }else{
                return response()->json("indeterminate error");
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
        $brands = Brand::findOrFail($id);
        $brands->delete();
        //respuesta en json
        return response()->json([true]);
    }
}
