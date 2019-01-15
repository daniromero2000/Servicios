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
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $creditPolicy = DB::table('credit_policy')
                    ->where(function ($query) use ($request){
                            $query->where('name','LIKE','%' . $request->q . '%');
                    });
        
        $creditPolicy->orderBy('id', 'desc')
                ->skip($request->page*($request->actual-1))
                ->take($request->page);
        
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
        $creditPolicy = new CreditPolicy();

        $creditPolicy->name = $request->get('nombre');

        if($creditPolicy->save()){
            return $creditPolicy->id;
        }else{
            return false;
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
        $creditPolicy= CreditPolicy::Find($id);

        return response()->json($creditPolicy);
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
        $creditPolicy=CreditPolicy::findOrFail($id);

        $creditPolicy->name = $request->get('name');
        $creditPolicy->score = $request->get('score');
        $creditPolicy->scoreEnd = $request->get('scoreEnd');
        $creditPolicy->salary = $request->get('salary');
        $creditPolicy->salaryEnd = $request->get('salaryEnd');
        $creditPolicy->age = $request->get('age');
        $creditPolicy->ageEnd = $request->get('ageEnd');
        $creditPolicy->activity = $request->get('activity');
        $creditPolicy->quotaApproved = $request->get('quotaApproved');
        
        $creditPolicy->save();

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
