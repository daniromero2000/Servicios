<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $query = "SELECT leads.`id`, leads.`name`, leads.`lastName`, leads.`email`, leads.`telephone`, leads.`city`, leads.`typeService`, leads.`typeProduct`, leads.`created_at`, leads.`state`,leads.`channel`,liquidator.`creditLine`, liquidator.`pagaduria`, liquidator.`age`, liquidator.`customerType`, liquidator.`salary` 
            FROM leads 
            LEFT JOIN `liquidator` ON liquidator.`idLead` = leads.`id`
            WHERE 1 AND leads.`channel` = 0";

        if($request->get('q')){
            $query .= sprintf(" AND (leads.`name` LIKE '%s' OR leads.`lastName` LIKE '%s') ", '%'.$request->get('q').'%', '%'.$request->get('q').'%');
        }

        if($request->get('state')){
            $query .= sprintf(" AND leads.`state` = %s ", $request->get('state'));
        }

        if($request->get('city')){
            $query .= sprintf(" AND leads.`city` = '%s' ", $request->get('city'));
        }

        if($request->get('typeProduct')){
            $query .= sprintf(" AND leads.`typeProduct` = '%s' ", $request->get('typeProduct'));
        }

        if($request->get('typeService')){
            $query .= sprintf(" AND leads.`typeService` = '%s' ", $request->get('typeService'));
        }

        if($request->get('fecha_ini')){
            $query .= sprintf(" AND leads.`created_at` > '%s' ", $request->get('fecha_ini').' 00:00:00');
        }

        if($request->get('fecha_fin')){
            $query .= sprintf(" AND leads.`created_at` < '%s' ", $request->get('fecha_fin').' 23:59:59');
        }

        if($request->get('libranzaLead')){
            $query .= sprintf(" AND leads.`state` != 0 ");
        }

        if($request->get('communityLead')){
            $query .= sprintf(" AND leads.`channel` != 1 ");
        }
      
        
        $query .= " ORDER BY leads.`id` DESC";

        $query .= sprintf(" LIMIT %s,30", $request->get('limitFrom'));

        $resp = DB::select($query);

        return $resp;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $lead= new Lead;

        $lead->name=$request->get('name');
        $lead->lastName=$request->get('lastName');
        $lead->email=$request->get('email');
        $lead->telephone=$request->get('telephone');
        $lead->city=$request->get('city');
        $lead->typeService=$request->get('typeService');
        $lead->typeProduct=$request->get('typeProduct');
        $lead->channel=intval($request->get('channel'));
        $lead->termsAndConditions=$request->get('termsAndConditions');
        $lead->campaign= $request->get('campaign');

        $lead->save();

        return response()->json([true]);
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
        //
    }
}
