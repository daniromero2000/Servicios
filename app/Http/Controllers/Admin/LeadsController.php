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
use Illuminate\Support\Facades\Auth;

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
    public function index(Request $request){
        $leadsDigital = [];

        $query = "SELECT cf.`NOMBRES`, cf.`APELLIDOS`, cf.`CELULAR`, cf.`CIUD_UBI`, cf.`CEDULA`, cf.`CREACION`, sb.`SOLICITUD`, sb.`ASESOR_DIG`,tar.`CUP_COMPRA`, tar.`CUPO_EFEC`
        FROM `CLIENTE_FAB` as cf, `SOLIC_FAB` as sb, `TARJETA` as tar
        WHERE sb.`CLIENTE` = cf.`CEDULA` AND cf.`SUBTIPO` = 'WEB' AND cf.`CON3` = 'PREAPROBADO' AND sb.ESTADO = 'APROBADO' AND sb.`GRAN_TOTAL` = 0 AND tar.`CLIENTE` = cf.`CEDULA`";

        if($request->q != ''){
            $query .= sprintf(" AND(cf.`NOMBRES` LIKE '%s' OR cf.`CEDULA` LIKE '%s' OR sb.`SOLICITUD` LIKE '%s' ) ", '%'.$request->q.'%', '%'.$request->q.'%', '%'.$request->q.'%');
        }

        $query .= " ORDER BY sb.`ASESOR_DIG`, cf.`CREACION` DESC";

        $query .= sprintf(" LIMIT %s,30", $request->get('initFrom'));

        $resp = DB::connection('oportudata')->select($query);

        foreach ($resp as $key => $lead) {
            $queryChannel = sprintf("SELECT `channel`, `id`, `state` FROM `leads` WHERE `identificationNumber` = %s ", trim($lead->CEDULA));
            $respChannel = DB::select($queryChannel);
            if($lead->ASESOR_DIG != ''){
                $queryAsesorDigital = sprintf("SELECT `name` FROM `users` WHERE `id` = %s ", trim($lead->ASESOR_DIG));
                $respAsesorDigital = DB::select($queryAsesorDigital);
                $resp[$key]->nameAsesor = (count($respAsesorDigital) > 0) ? $respAsesorDigital[0]->name : '' ;
            }
            $resp[$key]->channel = $respChannel[0]->channel;
            $resp[$key]->id = $respChannel[0]->id;
            $resp[$key]->state = $respChannel[0]->state;
            $leadsDigital[] = $resp[$key];
        }

        $queryCM = "SELECT lead.`id`, lead.`name`, lead.`lastName`, CONCAT(lead.`name`,' ',lead.`lastName`) as nameLast, lead.`email`, lead.`telephone`, lead.`identificationNumber`, lead.`created_at`, lead.`city`, lead.`typeService`, lead.`state`, lead.`channel`, lead.`campaign`, cam.`name` as campaignName
        FROM `leads` as lead
        LEFT JOIN `campaigns` as cam ON cam.id = lead.campaign 
        WHERE (`channel` = 2 OR `channel` = 3)";
        if($request->qCM !=''){
            $queryCM .= sprintf(" AND (`name` LIKE '%s' OR `lastName` LIKE '%s' OR `identificationNumber` LIKE '%s' )", '%'.$request->qCM.'%', '%'.$request->qCM.'%', '%'.$request->qCM.'%');
        }

        $queryCM .= "ORDER BY `created_at` DESC ";
        $queryCM .= sprintf(" LIMIT %s,30", $request->get('initFromCM'));
        $respCM = DB::select($queryCM);

        return response()->json(['leadsDigital' => $leadsDigital, 'leadsCM' => $respCM]);
    }

    public function assignAssesorDigitalToLead($solicitud){
        $idAsesor = Auth::user()->id;

        $query = sprintf("UPDATE `SOLIC_FAB` SET `ASESOR_DIG` = %s WHERE `SOLICITUD` = %s ", $idAsesor, $solicitud);
        $resp = DB::connection('oportudata')->select($query);

        return $resp;
    }
   
    public function checkLeadProcess($idLead){
        if($idLead == '') return -1;

        $query = sprintf("UPDATE `leads` SET `state` = 2 WHERE `id` = %s ", $idLead);

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
