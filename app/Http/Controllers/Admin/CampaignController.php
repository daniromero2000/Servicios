<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Campaigns;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

          $query = "SELECT `id`, `name`, `description`, `socialNetwork`, `beginDate`, `endingDate`, `budget`, `usedBudget` 
            FROM campaigns 
            WHERE 1";

        if($request->get('q')){
            $query .= sprintf(" AND (`name` LIKE '%s') ", '%'.$request->get('q').'%');
        }

        if($request->get('beginDate')){
            $query .= sprintf(" AND `beginDate` = '%s' ", $request->get('beginDate'));
        }

        if($request->get('endingDate')){
            $query .= sprintf(" AND `endingDate` = '%s' ", $request->get('endingDate'));
        }
        

        $query .= " ORDER BY `id` DESC";
        $initFrom = ($request->get('limitFrom')) ? $request->get('limitFrom') : 0 ;
        $query .= sprintf(" LIMIT %s,30", $initFrom);

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
