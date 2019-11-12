<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CreditPolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $creditPolicy = DB::connection('oportudata')->table('VIG_CONSULTA');

        return $creditPolicy->get();
    }

    public function create()
    { }

    public function store(Request $request)
    { }

    public function show($id)
    { }

    public function edit($id)
    { }

    public function update(Request $request, $id)
    {
        $creditPolicy = [
            'pub_vigencia'       => $request->get('pub_vigencia'),
            'fab_vigencia'       => $request->get('fab_vigencia'),
            'sms_vigencia'       => $request->get('sms_vigencia'),
            'rechazado_vigencia' => $request->get('rechazado_vigencia')
        ];

        $creditPolicy = DB::connection('oportudata')->table('VIG_CONSULTA')->update($creditPolicy);

        return response()->json([true]);
    }

    public function destroy($id)
    { }

    public function simulateCreditPolicy(Request $request)
    {
        return response()->json($request);
    }
}
