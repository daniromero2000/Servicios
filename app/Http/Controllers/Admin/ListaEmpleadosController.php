<?php

namespace App\Http\Controllers\Admin;

use App\ListaEmpleados;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListaEmpleadosController extends Controller
{
    public function index(Request $request)
    {
        $employes = DB::connection('oportudata')->table('LISTA_EMPLEADOS')
            ->select('identificador', 'num_documento', 'nombre')
            ->where('estado', '=', '1')
            ->where(function ($query) use ($request) {
                $query->where('num_documento', 'LIKE', '%' . $request->q . '%')
                    ->Orwhere('nombre', 'LIKE', '%' . $request->q . '%');
            });

        $employes->orderBy('identificador', 'desc')
            ->skip($request->page * ($request->actual - 1))
            ->take($request->page);

        return response()->json([
            'employes' => $employes->get()
        ]);
    }


    public function create()
    { }

    public function store(Request $request)
    {
        $existEmployeNew = $this->existEmploye($request->num_documento);
        if ($existEmployeNew == 1) {
            return -1;
        }
        $listaEmpleado = new ListaEmpleados;

        $listaEmpleado->nombre = $request->nombre;
        $listaEmpleado->num_documento = $request->num_documento;

        return response()->json($listaEmpleado->save());
    }

    private function existEmploye($identificationNumber)
    {
        $employe = DB::connection('oportudata')->table('LISTA_EMPLEADOS')->where('num_documento', '=', $identificationNumber)->get();
        if (count($employe) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function show($id)
    { }

    public function edit($id)
    { }

    public function update(Request $request, $id)
    { }

    public function destroy($id)
    {
        $listaEmpleado = ListaEmpleados::Find($id);
        $listaEmpleado->estado = 0;
        return response()->json($listaEmpleado->save());
    }
}
