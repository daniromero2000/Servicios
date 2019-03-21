<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Simulator;
use App\TimeLimits;

class SimulatorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('simulator.index');
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
           $timeLimit = new TimeLimits;
           $timeLimit->timeLimit = $request->timeLimit;
           $timeLimit->save();
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
    public function update(Request $request,$id)
    {
        try {
            //quey 
           $params = Simulator::find($id);
           $params->rate = $request->rate;
           $params->gap = $request->gap;
           $params->assurance = $request->assurance;
           $params->save();
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
          $timeLimit = TimeLimits::findOrFail($id);
          $timeLimit->delete();
          // json respons
          return response()->json([true]);
    }

    public function getData(){

       /* $params=Simulator::select('rate','gap','assurance')->get();
        $timeLimits=TimeLimits::select('id','timeLimit')->get();
        $data['params']=$params;
        $data['timeLimits']=$timeLimits;*/

        return response()->json([2]);
    }
}
