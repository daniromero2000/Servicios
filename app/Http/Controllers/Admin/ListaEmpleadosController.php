<?php

namespace App\Http\Controllers\Admin;

use App\ListaEmpleados;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListaEmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employes = DB::connection('oportudata')->table('LISTA_EMPLEADOS')
            ->select('identificador', 'num_documento', 'nombre')
            ->where('estado','=','1')
            ->where(function ($query) use ($request){
                    $query->where('num_documento','LIKE','%' . $request->q . '%')
                            ->Orwhere('nombre','LIKE','%' . $request->q . '%');
            });

        $employes->orderBy('identificador', 'desc')
                ->skip($request->page*($request->actual-1))
                ->take($request->page);

        return response()->json(['employes' => $employes->get()]);
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
    public function store(Request $request){
        $existEmployeNew = $this->existEmploye($request->num_documento);
        if($existEmployeNew == 1){
            return -1;
        }
        $listaEmpleado = new ListaEmpleados;

        $listaEmpleado->nombre = $request->nombre;
        $listaEmpleado->num_documento = $request->num_documento;

        return response()->json($listaEmpleado->save());
    }

    private function existEmploye($identificationNumber){
        $employe = DB::connection('oportudata')->table('LISTA_EMPLEADOS')->where('num_documento','=',$identificationNumber)->get();
        if(count($employe) > 0){
            return 1;
        }else{
            return 0;
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
        $listaEmpleado = ListaEmpleados::Find($id);
        $listaEmpleado->estado = 0;
        return response()->json($listaEmpleado->save());
    }
}
