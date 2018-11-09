<?php

namespace App\Http\Controllers\Admin;

use App\Lead;
use App\Liquidator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeadsController extends Controller
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
    public function index(Request $request)
    {

        $leadsQuery = Lead::selectRaw('leads.id, leads.name, leads.lastName, leads.email, leads.telephone, leads.city, leads.typeService, leads.typeProduct, leads. created_at,
                                    liquidator.creditLine, liquidator.pagaduria, liquidator.age, liquidator.customerType, liquidator.salary');
        $leadsQuery = Lead::leftjoin('liquidator','leads.id','=','liquidator.idLead');
        if($request->get('q')){
            $leadsQuery = Lead::whereRaw("leads.name LIKE '%".$request->get('q')."%' OR leads.lastName LIKE '%".$request->get('q')."%' ")
                ->orderBy('leads.id','desc')->paginate(3);
        }else{
            $leadsQuery = Lead::orderBy('leads.id','desc')->paginate(3);
        }

        return response($leadsQuery);
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
        $leads=Lead::find($id);
        $leadsQuery = Lead::selectRaw('leads.*,liquidator.*')
                    ->leftjoin('liquidator','leads.id','=','liquidator.idLead')
                    ->where('leads.id','=',$leads->id)
                    ->orderBy('leads.id')->get();


        return view('leads.show',compact('leads','leadsQuery'));
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
