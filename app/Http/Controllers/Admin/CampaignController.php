<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Campaigns;
use Illuminate\Support\Facades\DB;
use App\Imagenes;
use App\CampaignImages;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

          $query = "SELECT `campaign_images`.`name` AS imageName,`campaigns`.`id`, `campaigns`.`name`, `campaigns`.`description`, `campaigns`.`socialNetwork`, `campaigns`.`beginDate`, `campaigns`.`endingDate`, `campaigns`.`budget`, `campaigns`.`usedBudget`,`campaigns`.`remove` 
            FROM campaigns  LEFT JOIN `campaign_images` ON `campaigns`.`id` = `campaign_images`.`campaign`
            WHERE 1 AND `remove`= 0";

        if($request->get('q')){
            $query .= sprintf(" AND (`name` LIKE '%s') ", '%'.$request->get('q').'%');
        }

        if($request->get('socialNetwork')){
            $query .= sprintf(" AND `socialNetwork` = '%s' ", $request->get('socialNetwork'));
        }

        if($request->get('budget')){
            $query .= sprintf(" AND `budget` = '%s' ", $request->get('budget'));
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

        $campaign = new Campaigns;
        $campaign->name = $request->get('name')? $request->get('name'):'';
        $campaign->socialNetwork = $request->get('socialNetwork')?$request->get('socialNetwork'):'';
        $campaign->description = $request->get('description')?$request->get('description'):'';
        $campaign->beginDate = $request->get('beginDate');
        $campaign->endingDate = $request->get('endingDate');
        $campaign->budget = $request->get('budget')? intval($request->get('budget')):0;
        $campaign->usedBudget = $request->get('usedBudget')?intval($request->get('usedBudget')):0;
        
        $campaign->save();

        return response()->json($campaign->id);

    }

    public function storeImage(Request $request){

        for ($i=0; $i < (int)$request->nImages ; $i++) { 

            $imageCampaign = new CampaignImages;
            
            $imageCampaign->name =  Explode("/",$request->file('imgs'.$i)->store('public'))[1];//take only name
           // $images->name =  Explode("/",$request->file('imgs'.$i)->store('public'))[1];//take only name
            $imageCampaign->campaign= $request->idCampaign;

            $imageCampaign->save();

        }        

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

        /*$idProfileUser=User::selectRaw('profiles.id AS profileID, profiles.name AS profileName,users.idProfile AS userProfile')
        ->leftjoin('profiles','profiles.id','=','users.idProfile')
        ->where('profiles.id','=',(int)$request->get('idProfile'))
        ->orderBy('profiles.id')->first();*/

        $campaign=Campaigns::selectRaw('campaign_images.name AS imageName,campaigns.id, campaigns.name, campaigns.description, campaigns.socialNetwork, campaigns.beginDate, campaigns.endingDate, campaigns.budget, campaigns.usedBudget,campaigns.remove')
        ->leftjoin('campaign_images','campaigns.id','=','campaign_images.campaign')
        ->where('campaigns.id','=',$id)
        ->orderBy('campaigns.id')->first();

      

        // $campaign=Campaigns::findOrfail($id);

        return response()->json($campaign);
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
    public function update(Request $request)
    {

        $campaign=Campaigns::findOrfail($request->get('id'));
        
        $campaign->name = $request->get('name');
        $campaign->socialNetwork = $request->get('socialNetwork');
        $campaign->description = $request->get('description');
        $campaign->beginDate = $request->get('beginDate');
        $campaign->endingDate = $request->get('endingDate');
        $campaign->budget = intval($request->get('budget'));
        $campaign->usedBudget = intval($request->get('usedBudget'));
        $campaign->save();

        return response()->json([true]);

    }

    public function deleteCampaign(Request $request){
        $campaign=Campaigns::findOrfail($request->get('id'));
        $campaign->remove = 1;

        $campaign->save();

        return response()->json($campaign);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
            $Campaign=Campaigns::findOrfail($id);
            $Campaign->delete();

            return response()->json([true]);
    }
}
