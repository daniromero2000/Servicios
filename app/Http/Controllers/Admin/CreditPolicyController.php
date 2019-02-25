<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CreditPolicy;
use Illuminate\Support\Facades\DB;

class CreditPolicyController extends Controller
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
        $creditPolicy = DB::connection('oportudata')->table('VIG_CONSULTA');
        
        return $creditPolicy->get();
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
        //
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

        $creditPolicy = [
            'pub_vigencia' => $request->get('pub_vigencia'),
            'fab_vigencia' => $request->get('fab_vigencia'),
            'sms_vigencia' => $request->get('sms_vigencia'),
            'rechazado_vigencia' => $request->get('rechazado_vigencia')
        ];

        $creditPolicy = DB::connection('oportudata')->table('VIG_CONSULTA')->update($creditPolicy);

        return response()->json([true]);
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

    public function simulateCreditPolicy(Request $request){
        return response()->json($request);
    }
}
