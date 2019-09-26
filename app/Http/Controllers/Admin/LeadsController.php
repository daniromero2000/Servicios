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
    public function index(Request $request)
    {
        return $getLeadsTR = $this->getLeadsTradicional(['qTR' => $request->get('qTR'), 'initFromTR' => $request->get('initFromTR')]);
        $leadsTR = $getLeadsTR['leadsTR'];
        $totalLeadsTR = $getLeadsTR['totalLeadsTR'];

        $getLeadsDigital = $this->getLeadsCanalDigital(['q' => $request->get('q'), 'initFrom' => $request->get('initFrom')]);
        $leadsDigital = $getLeadsDigital['leadsDigital'];
        $totalLeadsDigital = $getLeadsDigital['totalLeads'];

        $getLeadsCM = $this->getLeadsCM(['qCM' => $request->get('qCM'), 'initFromCM' => $request->get('initFromCM')]);
        $leadsCM = $getLeadsCM['leadsCM'];
        $totalLeadsCM = $getLeadsCM['totalLeadsCM'];

        $getLeadsGen = $this->getGenLeads(['qGen' => $request->get('qGen'), 'initFromGen' => $request->get('initFromGen')]);
        $leadsGen = $getLeadsGen['leadsGen'];
        $totalLeadsGen = $getLeadsGen['totalLeadsGen'];

        $getLeadsAL = $this->getLeadsAlmacen(['qAL' => $request->get('qAL'), 'initFromAL' => $request->get('initFromAL')]);
        $leadsAL = $getLeadsAL['leadsAL'];
        $totalLeadsAL = $getLeadsAL['totalLeadsAL'];

        $codeAsessor = Auth::user()->codeOportudata;
        return response()->json(['leadsDigital' => $leadsDigital, 'leadsCM' => $leadsCM, 'totalLeads' => $totalLeadsDigital, 'totalLeadsCM' => $totalLeadsCM, 'codeAsesor' => $codeAsessor, 'leadsGen' => $leadsGen, 'totalLeadsGen' => $totalLeadsGen, 'leadsTR' => $leadsTR, 'totalLeadsTR' => $totalLeadsTR, 'leadsAL' => $leadsAL, 'totalLeadsAL' => $totalLeadsAL]);
    }

    private function getGenLeads($request)
    {
        $totalLeadsCM = 0;

        $queryGenLeads = "SELECT lead.`id`, lead.`name`, lead.`lastName`, CONCAT(lead.`name`,' ',lead.`lastName`) as nameLast, lead.`email`, lead.`telephone`, lead.`identificationNumber`, lead.`created_at`, lead.`city`, lead.`typeService`, lead.`state`, lead.`channel`, lead.`nearbyCity`
        FROM `leads` as lead
        WHERE `typeService` IN  ('Credito libranza','Motos','Seguros','Libranza') AND lead.`state` !=  3 ";
        $respTotalLeadsGen = DB::select($queryGenLeads);
        $totalLeadsGen = count($respTotalLeadsGen);
        if ($request['qGen'] != '') {
            $queryGenLeads .= sprintf(" AND (lead.`name` LIKE '%s' OR lead.`lastName` LIKE '%s' OR lead.`typeService` LIKE '%s' ) ", '%' . $request['qGen'] . '%', '%' . $request['qGen'] . '%', '%' . $request['qGen'] . '%');
        }

        $queryGenLeads .= "ORDER BY `created_at` DESC ";
        $queryGenLeads .= sprintf(" LIMIT %s,30", $request['initFromGen']);
        $respGen = DB::select($queryGenLeads);

        return ['leadsGen' => $respGen, 'totalLeadsGen' => $totalLeadsGen];
    }

    private function getLeadsCanalDigital($request)
    {
        $leadsDigital = [];
        $totalLeadsDigital = 0;
        $codeAsessor = Auth::user()->codeOportudata;
        $queryIdEmpresa = sprintf("SELECT `ID_EMPRESA` FROM `ASESORES` WHERE `CODIGO` = '%s'", $codeAsessor);
        $IdEmpresa = DB::connection('oportudata')->select($queryIdEmpresa);

        $query = sprintf("SELECT cf.`NOMBRES`, cf.`APELLIDOS`, score.`score`,cf.`CELULAR`, cf.`CIUD_UBI`, cf.`CEDULA`, cf.`CREACION`, sb.`SOLICITUD`, sb.`ASESOR_DIG`,tar.`CUP_COMPRA`, tar.`CUPO_EFEC`, sb.`SUCURSAL`, sb.`CODASESOR`, ti.TARJETA
        FROM `CLIENTE_FAB` as cf, `SOLIC_FAB` as sb, `TARJETA` as tar, `cifin_score` as score, TB_INTENCIONES as ti
        WHERE sb.`CLIENTE` = cf.`CEDULA` 
        AND tar.`CLIENTE` = cf.`CEDULA`
        AND score.`scocedula` = cf.`CEDULA` 
        AND score.`scoconsul` = (SELECT MAX(`scoconsul`) FROM `cifin_score` WHERE `scocedula` = cf.`CEDULA` ) 
        AND sb.`SOLICITUD_WEB` = '1' 
        AND cf.`ESTADO` = 'PREAPROBADO' 
        AND sb.ESTADO = 'APROBADO' 
        AND sb.`GRAN_TOTAL` = 0 
        AND sb.SOLICITUD_WEB = 1
        AND ti.CEDULA = cf.CEDULA
        AND ti.FECHA_INTENCION = (SELECT MAX(`FECHA_INTENCION`) FROM `TB_INTENCIONES` WHERE `CEDULA` = `cf`.`CEDULA`)
        AND sb.`ID_EMPRESA` = %s ", $IdEmpresa[0]->ID_EMPRESA);

        $respTotalLeads = DB::connection('oportudata')->select($query);

        $totalLeadsDigital = count($respTotalLeads);

        if ($request['q'] != '') {
            $query .= sprintf(" AND(cf.`NOMBRES` LIKE '%s' OR cf.`CEDULA` LIKE '%s' OR sb.`SOLICITUD` LIKE '%s' ) ", '%' . $request['q'] . '%', '%' . $request['q'] . '%', '%' . $request['q'] . '%');
        }

        $query .= " ORDER BY sb.`ASESOR_DIG`, cf.`CREACION` DESC";

        $query .= sprintf(" LIMIT %s,30", $request['initFrom']);

        $resp = DB::connection('oportudata')->select($query);

        foreach ($resp as $key => $lead) {
            $queryChannel = sprintf("SELECT `channel`, `id`, `state` 
            FROM `leads` 
            WHERE `identificationNumber` = %s ", trim($lead->CEDULA));
            $respChannel = DB::select($queryChannel);
            if ($lead->ASESOR_DIG != '') {
                $queryAsesorDigital = sprintf("SELECT `name` FROM `users` WHERE `id` = %s ", trim($lead->ASESOR_DIG));
                $respAsesorDigital = DB::select($queryAsesorDigital);
                $resp[$key]->nameAsesor = (count($respAsesorDigital) > 0) ? $respAsesorDigital[0]->name : '';
            }
            $resp[$key]->channel = $respChannel[0]->channel;
            $resp[$key]->id = $respChannel[0]->id;
            $resp[$key]->state = $respChannel[0]->state;
            $leadsDigital[] = $resp[$key];
        }

        return ['leadsDigital' => $leadsDigital, 'totalLeads' => $totalLeadsDigital];
    }

    private function getLeadsCM($request)
    {
        $totalLeadsCM = 0;

        $queryCM = "SELECT lead.`id`, lead.`name`, lead.`lastName`, CONCAT(lead.`name`,' ',lead.`lastName`) as nameLast, lead.`email`, lead.`telephone`, lead.`identificationNumber`, lead.`created_at`, lead.`city`, lead.`typeService`, lead.`state`, lead.`channel`, lead.`campaign`, cam.`name` as campaignName, lead.`nearbyCity`
        FROM `leads` as lead
        LEFT JOIN `campaigns` as cam ON cam.id = lead.campaign 
        WHERE (`channel` = 2 OR `channel` = 3)";
        $respTotalLeadsCM = DB::select($queryCM);
        $totalLeadsCM = count($respTotalLeadsCM);
        if ($request['qCM'] != '') {
            $queryCM .= sprintf(" AND (lead.`name` LIKE '%s' OR lead.`lastName` LIKE '%s' OR lead.`identificationNumber` LIKE '%s' )", '%' . $request['qCM'] . '%', '%' . $request['qCM'] . '%', '%' . $request['qCM'] . '%');
        }

        $queryCM .= "ORDER BY `created_at` DESC ";
        $queryCM .= sprintf(" LIMIT %s,30", $request['initFromCM']);
        $respCM = DB::select($queryCM);

        return ['leadsCM' => $respCM, 'totalLeadsCM' => $totalLeadsCM];
    }

    private function getLeadsTradicional($request)
    {
        $queryTradicional = "SELECT  cf.`NOMBRES`, cf.`APELLIDOS`, cf.`CELULAR`, cf.`EMAIL`, cf.`ESTADO`, cf.`CIUD_UBI`, cf.`CEDULA`, cf.`CREACION` as CREACION, score.`score`, TB_DEFINICIONES.`DESCRIPCION`
        FROM `CLIENTE_FAB` as cf, `cifin_score` as score, `TB_INTENCIONES`
        LEFT JOIN TB_DEFINICIONES ON TB_INTENCIONES.ID_DEF = TB_DEFINICIONES.ID_DEF
        where
        `TB_INTENCIONES`.`Tarjeta` = 'Crédito Tradicional' AND `TB_INTENCIONES`.`CEDULA` = cf.`CEDULA` 
        AND score.`scocedula` = cf.`CEDULA` AND score.`scoconsul` = (SELECT MAX(`scoconsul`) FROM `cifin_score` WHERE `scocedula` = cf.`CEDULA` )
        AND cf.`ESTADO` = 'PREAPROBADO'
        AND TB_INTENCIONES.FECHA_INTENCION = (SELECT MAX(`FECHA_INTENCION`) FROM `TB_INTENCIONES` WHERE `CEDULA` = `cf`.`CEDULA`)
        ";

        $respTotalLeadsTradicional = DB::connection('oportudata')->select($queryTradicional);
        $totalLeadsTradicional = count($respTotalLeadsTradicional);

        if ($request['qTR'] != '') {
            return $queryTradicional .= sprintf(" AND(cf.`NOMBRES` LIKE '%s' OR cf.`CEDULA` LIKE '%s') ", '%' . $request['qTR'] . '%', '%' . $request['qTR'] . '%');
        }

        if ($request['qFechaInicialTR'] != '') {
            $request['qFechaInicialTR']." 00:00:00";
            return $queryTradicional .= sprintf(" AND(cf.`CREACION` >= '%s') ", '%' . $request['qFechaInicialTR'] . '%');
        }

        if ($request['qFechaFinalTR'] != '') {
            $request['qFechaFinalTR']." 23:59:59";
            return $queryTradicional .= sprintf(" AND(cf.`CREACION` >= '%s') ", '%' . $request['qFechaFinalTR'] . '%');
        }


        $queryTradicional .= sprintf(" LIMIT %s,30", $request['initFromTR']);

        $resp = DB::connection('oportudata')->select($queryTradicional);

        return ['leadsTR' => $resp, 'totalLeadsTR' => $totalLeadsTradicional];
    }

    private function getLeadsAlmacen($request)
    {
        $queryAlmacen = "SELECT cf.`NOMBRES`, cf.`APELLIDOS`, cf.`CELULAR`, cf.`ESTADO`, cf.`CIUD_UBI`, cf.`CEDULA`, cf.`CREACION` as CREACION, score.`score`  
        FROM `CLIENTE_FAB` as cf, `cifin_score` as score
        WHERE `ESTADO` = 'ALMACEN'
                AND score.`scocedula` = cf.`CEDULA` 
                AND score.`scoconsul` = (SELECT MAX(`scoconsul`) FROM `cifin_score` WHERE `scocedula` = cf.`CEDULA` )";

        $respTotalLeadsTradicional = DB::connection('oportudata')->select($queryAlmacen);
        $totalLeadsTradicional = count($respTotalLeadsTradicional);

        if ($request['qAL'] != '') {
            $queryAlmacen .= sprintf(" AND(`NOMBRES` LIKE '%s' OR `CEDULA` LIKE '%s') ", '%' . $request['qAL'] . '%', '%' . $request['qAL'] . '%');
        }

        $queryAlmacen .= sprintf(" LIMIT %s,30", $request['initFromAL']);

        $resp = DB::connection('oportudata')->select($queryAlmacen);

        return ['leadsAL' => $resp, 'totalLeadsAL' => $totalLeadsTradicional];
    }

    public function assignAssesorDigitalToLead($solicitud)
    {
        $idAsesor = Auth::user()->id;

        $query = sprintf("UPDATE `SOLIC_FAB` SET `ASESOR_DIG` = %s WHERE `SOLICITUD` = %s ", $idAsesor, $solicitud);
        $resp = DB::connection('oportudata')->select($query);

        return $resp;
    }

    public function checkLeadProcess($idLead)
    {
        if ($idLead == '') return -1;

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
    { }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leads = Lead::find($id);
        $leadsQuery = Lead::selectRaw('leads.*,liquidator.*')
            ->leftjoin('liquidator', 'leads.id', '=', 'liquidator.idLead')
            ->where('leads.id', '=', $leads->id)
            ->orderBy('leads.id')->get();


        return view('leads.show', compact('leads', 'leadsQuery'));
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

    public function addCommunityLeads(Request $request)
    {
        $idCampaign = NULL;

        $nameCampaign = (string) $request->get('campaign');
        $idCampaign = Campaigns::selectRaw('`id`,`name`')->where('name', '=', $nameCampaign)->get();
        //return $idCampaign;
        $idCampaign = (count($idCampaign) > 0) ? $idCampaign[0]->id : NULL;

        $lead = new Lead;

        $lead->name = $request->get('name');
        $lead->lastName = $request->get('lastName');
        $lead->email = $request->get('email');
        $lead->telephone = $request->get('telephone');
        $lead->identificationNumber = $request->get('identificationNumber');
        $lead->city = $request->get('city');
        $lead->typeProduct = $request->get('typeProduct');
        $lead->typeService = $request->get('typeService');
        $lead->channel = $request->get('channel');
        $lead->termsAndConditions = 2;
        $lead->campaign = $idCampaign;
        $lead->channel = $request->get('channel');
        $lead->nearbyCity = $request->get('nearbyCity');
        $lead->save();

        return response()->json($lead);
    }

    public function viewCommunityLeads($id)
    {

        $lead = Lead::findOrfail($id);

        return response()->json($lead);
    }

    public function deleteCommunityLeads($id)
    {

        $lead = Lead::findOrfail($id);
        $lead->delete();

        return response()->json([true]);
    }


    public function updateCommunityLeads(Request $request)
    {

        $nameCampaign = (string) $request->get('campaignName');
        $lead = lead::findOrfail($request->get('id'));

        if ($nameCampaign) {
            $idCampaign = Campaigns::selectRaw('`id`,`name`')->where('name', '=', $nameCampaign)->first();
            $idCampaign = $idCampaign->id;
            $lead->campaign = $idCampaign;
        } else {
            $lead->campaign = $request->get('campaign');
        }



        $lead->name = $request->get('name');
        $lead->lastName = $request->get('lastName');
        $lead->email = $request->get('email');
        $lead->telephone = $request->get('telephone');
        $lead->city = $request->get('city');
        $lead->typeProduct = $request->get('typeProduct');
        $lead->typeService = $request->get('typeService');
        $lead->channel = $request->get('channel');
        $lead->nearbyCity = $request->get('nearbyCity');


        $lead->save();

        return response()->json([true]);
    }


    public function addComent($lead, $comment)
    {
        $commentNew = new Comments;

        $currentUser = \Auth::user();
        $commentNew->idLogin = $currentUser->id;
        $commentNew->idLead = $lead;
        $commentNew->comment = $comment;

        $commentNew->save();

        return response()->json([true]);
    }


    public function getComentsLeads($idLead)
    {
        $query = sprintf("SELECT comments.`comment`, comments.`created_at`, users.`name` FROM `comments` 
                LEFT JOIN `users` ON comments.`idLogin` = users.`id`
                WHERE `idLead` = %s
                ORDER BY comments.`id` DESC", $idLead);
        $resp = DB::select($query);

        return $resp;
    }

    public function deniedRequest($idLead, $comment)
    {
        $employee = Lead::find($idLead);
        $employee->state = 4;
        $employee->save();

        $this->addComent($idLead, $comment);

        return response()->json([true]);
    }
}
