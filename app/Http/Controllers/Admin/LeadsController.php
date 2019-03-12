<?php

namespace App\Http\Controllers\Admin;

use App\Lead;
use App\Liquidator;
use App\Comments;
use App\Campaigns;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LeadsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }
    
    /**
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: return a filter leads list 
    **Date: 20/02/2019
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = "SELECT leads.`id`, leads.`identificationNumber`, leads.`name`, leads.`lastName`, leads.`email`, leads.`telephone`, leads.`city`, leads.`typeService`, leads.`typeProduct`, leads.`created_at`, leads.`state`,leads.`channel`,liquidator.`creditLine`, liquidator.`pagaduria`, liquidator.`age`, liquidator.`customerType`, liquidator.`salary`, campaigns.`name` as campaignName, campaigns.`socialNetwork` as socialNetwork
            FROM leads 
            LEFT JOIN `liquidator` ON liquidator.`idLead` = leads.`id`      
            LEFT JOIN `campaigns` ON campaigns.`id` = leads.`campaign`
            WHERE 1 ";

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
            $query .= sprintf(" AND leads.`channel` = 2");
        }
        
        $query .= " ORDER BY leads.`id` DESC";

        $query .= sprintf(" LIMIT %s,30", $request->get('limitFrom'));

        $resp = DB::select($query);
        //take a list of identification number
        $resp = collect($resp);
        $identification = $resp->pluck('identificationNumber');
        //take the last score store
        $latestScore = DB::connection('oportudata')->table('cifin_score')
                                                ->select('scocedula', 'score', DB::raw(' MAX(scoconsul) AS last'))
                                                ->groupBy('scocedula');
        //join a client info and score
        $oportudataLead = DB::connection('oportudata')->table('CLIENTE_FAB')
                                                    ->joinSub($latestScore, 'latestScore',function ($join){
                                                        $join->on('CEDULA','=', 'scocedula');
                                                    })
                                                    ->select('CON3','ACTIVIDAD','score','last','CEDULA')
                                                    ->whereIN('CEDULA',$identification)
                                                    ->get();
        //join a lead and oportudata info
        $resp = $resp->map(function ($item, $key) use ($oportudataLead) {
            $score = $oportudataLead->where('CEDULA',$item->identificationNumber)->values();//searcha a respectiv information in oportidata
            $score = $score->toArray();
            //asignation in resp item if empty return fields "" else assigns values 
            if (empty($score)) {
                return $item;
            }else{
                $item->score=$score[0]->score;
                $item->ocupacion=$score[0]->ACTIVIDAD;
                $item->estadoCredito=$score[0]->CON3;
                return $item;
            }
        });

        return   $resp;
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

     public function addCommunityLeads(Request $request){
        $idCampaign = NULL;

        $nameCampaign = (string)$request->get('campaign');
        $idCampaign =Campaigns::selectRaw('`id`,`name`')->where('name','=',$nameCampaign)->get();
        //return $idCampaign;
        $idCampaign = (count($idCampaign) > 0) ? $idCampaign[0]->id : NULL;

        $lead= new Lead;

        $lead->name=$request->get('name');
        $lead->lastName=$request->get('lastName');
        $lead->email=$request->get('email');
        $lead->telephone=$request->get('telephone');
        $lead->identificationNumber=$request->get('identificationNumber');
        $lead->city=$request->get('city');
        $lead->typeProduct=$request->get('typeProduct');
        $lead->typeService=$request->get('typeService');
        $lead->channel=$request->get('channel'); 
        $lead->termsAndConditions = 2;
        $lead->campaign= $idCampaign;

        $lead->save();

        return response()->json($lead);
        
    }

    public function viewCommunityLeads($id){

        $lead=Lead::findOrfail($id);

        return response()->json($lead);
    }

    public function deleteCommunityLeads($id){
        
        $lead=Lead::findOrfail($id);
        $lead->delete();

        return response()->json([true]);
    }


    public function updateCommunityLeads(Request $request){

        $nameCampaign = (string)$request->get('campaignName');
        $lead=lead::findOrfail($request->get('id'));

        if($nameCampaign){
            $idCampaign =Campaigns::selectRaw('`id`,`name`')->where('name','=',$nameCampaign)->first();        
            $idCampaign = $idCampaign->id; 
            $lead->campaign =$idCampaign;
        }else{
            $lead->campaign =$request->get('campaign');
        }
        

        
        $lead->name = $request->get('name');
        $lead->lastName = $request->get('lastName');
        $lead->email = $request->get('email');
        $lead->telephone = $request->get('telephone');
        $lead->city = $request->get('city');
        $lead->typeProduct = $request->get('typeProduct');
        $lead->typeService = $request->get('typeService');
        $lead->channel = $request->get('channel');
        

        $lead->save();

        return response()->json([true]);
    }


    public function addComent($lead, $comment){
        $commentNew= new Comments;
        
        $currentUser=\Auth::user();
        $commentNew->idLogin = $currentUser->id;
        $commentNew->idLead = $lead;
        $commentNew->comment = $comment;

        $commentNew->save();

        return response()->json([true]);
    }


    public function getComentsLeads($idLead){
        $query = sprintf("SELECT comments.`comment`, comments.`created_at`, users.`name` FROM `comments` 
                LEFT JOIN `users` ON comments.`idLogin` = users.`id`
                WHERE `idLead` = %s
                ORDER BY comments.`id` DESC", $idLead);
        $resp = DB::select($query);

        return $resp;
    }

    public function deniedRequest($idLead, $comment){
        $employee = Lead::find($idLead);
        $employee->state = 4;
        $employee->save();

        $this->addComent($idLead, $comment);

        return response()->json([true]);
    }
}
