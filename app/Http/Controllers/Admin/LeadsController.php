<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Leads\Lead;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;
use App\Entities\Campaigns\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\FactoryRequests\Repositories\Interfaces\FactoryRequestRepositoryInterface;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Leads\Repositories\LeadRepository;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LeadsController extends Controller
{
    private $codeAsessor, $assessorInterface, $IdEmpresa, $leadInterface;
    private $userInterface, $user, $campaignInterface;
    private $customerInterface, $factoryRequestInterface;

    public function __construct(
        AssessorRepositoryInterface $assessorRepositoryInterface,
        LeadRepositoryInterface $leadRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface,
        CampaignRepositoryInterface $campaignRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        FactoryRequestRepositoryInterface $FactoryRequestRepositoryInterface
    ) {
        $this->campaignInterface = $campaignRepositoryInterface;
        $this->userInterface     = $userRepositoryInterface;
        $this->leadInterface     = $leadRepositoryInterface;
        $this->assessorInterface = $assessorRepositoryInterface;
        $this->customerInterface = $customerRepositoryInterface;
        $this->factoryRequestInterface = $FactoryRequestRepositoryInterface;
        $this->middleware('auth')->except('logout');
    }

    public function index(Request $request)
    {
        $this->user = auth()->user();
        $this->codeAsessor = $this->user->codeOportudata;

        $getLeadsDigitalAnt   = $this->getLeadsCanalDigitalAnt([
            'q'              => $request->get('q'),
            'initFromAnt'    => $request->get('initFromAnt'),
            'qcityAprobados' => $request->get('qcityAprobados'),
            'qfechaInicialAprobados' => $request->get('qfechaInicialAprobados'),
            'qfechaFinalAprobados'   => $request->get('qfechaFinalAprobados')
        ]);

        $getLeadsTR = $this->getLeadsTradicional([
            'q'              => $request->get('q'),
            'initFromTR'      => $request->get('initFromTR'),
            'qfechaInicialTR' => $request->get('qfechaInicialTR'),
            'qfechaFinalTR'   => $request->get('qfechaFinalTR'),
            'qcityAprobados' => $request->get('qcityAprobados'),
        ]);

        $getLeadsDigital = $this->getLeadsCanalDigital([
            'q'                      => $request->get('q'),
            'initFrom'               => $request->get('initFrom'),
            'qtipoTarjetaAprobados'  => $request->get('qtipoTarjetaAprobados'),
            'qOrigenAprobados'       => $request->get('qOrigenAprobados'),
            'qcityAprobados'         => $request->get('qcityAprobados'),
            'qfechaInicialAprobados' => $request->get('qfechaInicialAprobados'),
            'qfechaFinalAprobados'   => $request->get('qfechaFinalAprobados')
        ]);

        $getLeadsCM = $this->getLeadsCM([
            'q'        => $request->get('q'),
            'initFromCM' => $request->get('initFromCM'),
            'qcityAprobados'         => $request->get('qcityAprobados'),
            'qleadChannel'         => $request->get('qleadChannel'),
            'qfechaInicialAprobados' => $request->get('qfechaInicialAprobados'),
            'qfechaFinalAprobados'   => $request->get('qfechaFinalAprobados')
        ]);

        $getLeadsGen = $this->getGenLeads([
            'q'        => $request->get('q'),
            'initFromGen' => $request->get('initFromGen'),
            'qcityAprobados'         => $request->get('qcityAprobados'),
            'qfechaInicialAprobados' => $request->get('qfechaInicialAprobados'),
            'qfechaFinalAprobados'   => $request->get('qfechaFinalAprobados')
        ]);

        return response()->json([
            'leadsDigitalAnt' => $getLeadsDigitalAnt['leadsDigitalAnt'],
            'leadsDigital'    => $getLeadsDigital['leadsDigital'],
            'leadsCM'         => $getLeadsCM['leadsCM'],
            'totalLeads'      => $getLeadsDigital['totalLeads'],
            'totalLeadsAnt'   => $getLeadsDigitalAnt['totalLeadsAnt'],
            'totalLeadsCM'    => $getLeadsCM['totalLeadsCM'],
            'codeAsesor'      => $this->codeAsessor,
            'leadsGen'        => $getLeadsGen['leadsGen'],
            'totalLeadsGen'   => $getLeadsGen['totalLeadsGen'],
            'leadsTR'         => $getLeadsTR['leadsTR'],
            'totalLeadsTR'    => $getLeadsTR['totalLeadsTR'],
        ]);
    }

    private function getLeadsCanalDigitalAnt($request)
    {
        $this->IdEmpresa = $this->assessorInterface->getAssessorCompany($this->codeAsessor);

        $query = sprintf("SELECT cf.`NOMBRES`, cf.`APELLIDOS`, cf.`CELULAR`, cf.`CIUD_UBI`, cf.`CEDULA`,  sb.FECHASOL, sb.`SOLICITUD`, sb.`ASESOR_DIG`,tar.`CUP_COMPRA`, tar.`CUPO_EFEC`, sb.`SUCURSAL`
        FROM `CLIENTE_FAB` as cf, `SOLIC_FAB` as sb, `TARJETA` as tar
        WHERE sb.`CLIENTE` = cf.`CEDULA`
        AND tar.`CLIENTE` = cf.`CEDULA`
        AND sb.`SOLICITUD_WEB` = 1
        AND cf.`ESTADO` = 'PREAPROBADO'
        AND sb.ESTADO = 'APROBADO'
        AND sb.`GRAN_TOTAL` = 0
        AND sb.`ID_EMPRESA` = %s ", $this->IdEmpresa[0]->ID_EMPRESA);

        if ($request['q'] != '') {
            $query .= sprintf(
                " AND (cf.`NOMBRES` LIKE '%s' OR cf.`CEDULA` LIKE '%s' OR sb.`SOLICITUD` LIKE '%s' OR cf.`CELULAR` LIKE '%s' ) ",
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%'
            );
        }

        if ($request['qcityAprobados'] != '') {
            $query .= sprintf(" AND (cf.`CIUD_UBI` = '%s') ", $request['qcityAprobados']);
        }

        if ($request['qfechaInicialAprobados'] != '') {
            $request['qfechaInicialAprobados'] .= " 00:00:00";
            $query .= sprintf(" AND (sb.`FECHASOL` >= '%s') ", $request['qfechaInicialAprobados']);
        }

        if ($request['qfechaFinalAprobados'] != '') {
            $request['qfechaFinalAprobados'] .= " 23:59:59";
            $query .= sprintf(" AND (sb.`FECHASOL` <= '%s') ", $request['qfechaFinalAprobados']);
        }

        $respTotalLeads = DB::connection('oportudata')->select($query);
        $query .= " ORDER BY sb.`ASESOR_DIG`, sb.`FECHASOL` DESC";
        $query .= sprintf(" LIMIT %s,30", $request['initFromAnt']);

        $resp         = DB::connection('oportudata')->select($query);
        $leadsDigital = [];

        foreach ($resp as $key => $lead) {
            if ($lead->ASESOR_DIG != '') {
                $resp[$key]->nameAsesor = $this->userInterface->getUserName($lead->ASESOR_DIG)->name;
            }

            $respChannel         = $this->leadInterface->getLeadChannel($lead->CEDULA);
            $resp[$key]->channel = $respChannel[0]->channel;
            $resp[$key]->id      = $respChannel[0]->id;
            $resp[$key]->state   = $respChannel[0]->state;
            $leadsDigital[]      = $resp[$key];
        }

        return [
            'leadsDigitalAnt' => $leadsDigital,
            'totalLeadsAnt'   => count($respTotalLeads)
        ];
    }


    private function getLeadsCanalDigital($request)
    {
        $query = sprintf("SELECT cf.`NOMBRES`, cf.`APELLIDOS`, cf.`CELULAR`, cf.`CIUD_UBI`, cf.`CEDULA`, cf.`CREACION`, cf.`ORIGEN`, cf.`PLACA`, sb.`SOLICITUD`, sb.`ASESOR_DIG`,tar.`CUP_COMPRA`, tar.`CUPO_EFEC`, sb.`SUCURSAL`, ti.TARJETA, sb.FECHASOL
        FROM `CLIENTE_FAB` as cf, `SOLIC_FAB` as sb, `TARJETA` as tar,  TB_INTENCIONES as ti
        WHERE sb.`CLIENTE` = cf.`CEDULA`
        AND tar.`CLIENTE` = cf.`CEDULA`
        AND sb.ESTADO = 'APROBADO'
        AND sb.`GRAN_TOTAL` = 0
        AND sb.SOLICITUD_WEB = 1
        AND sb.STATE = 'A'
        AND (cf.`ESTADO` = 'APROBADO' OR cf.`ESTADO` = 'PREAPROBADO')
        AND ti.CEDULA = cf.CEDULA
        AND ti.FECHA_INTENCION = (SELECT MAX(`FECHA_INTENCION`) FROM `TB_INTENCIONES` WHERE `CEDULA` = `cf`.`CEDULA`)
        AND sb.`ID_EMPRESA` = %s ", $this->IdEmpresa[0]->ID_EMPRESA);

        if ($request['q'] != '') {
            $query .= sprintf(
                " AND (cf.`NOMBRES` LIKE '%s' OR cf.`CEDULA` LIKE '%s' OR sb.`SOLICITUD` LIKE '%s' OR cf.`CELULAR` LIKE '%s' ) ",
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%'
            );
        }

        if ($request['qtipoTarjetaAprobados'] != '') {
            $query .= sprintf(" AND (ti.`TARJETA` = '%s') ", $request['qtipoTarjetaAprobados']);
        }

        if($request['qOrigenAprobados'] != ''){
            $query .= sprintf(" AND (cf.`ORIGEN` = '%s') ", $request['qOrigenAprobados']);
        }

        if ($request['qcityAprobados'] != '') {
            $query .= sprintf(" AND (cf.`CIUD_UBI` = '%s') ", $request['qcityAprobados']);
        }

        if ($request['qfechaInicialAprobados'] != '') {
            $request['qfechaInicialAprobados'] .= " 00:00:00";
            $query .= sprintf(" AND (sb.`FECHASOL` >= '%s') ", $request['qfechaInicialAprobados']);
        }

        if ($request['qfechaFinalAprobados'] != '') {
            $request['qfechaFinalAprobados'] .= " 23:59:59";
            $query .= sprintf(" AND (sb.`FECHASOL` <= '%s') ", $request['qfechaFinalAprobados']);
        }

        $respTotalLeads = DB::connection('oportudata')->select($query);
        $query .= " ORDER BY sb.`ASESOR_DIG`, sb.`FECHASOL` DESC";
        $query .= sprintf(" LIMIT %s,30", $request['initFrom']);

        $resp         = DB::connection('oportudata')->select($query);
        $leadsDigital = [];

        foreach ($resp as $key => $lead) {
            if ($lead->ASESOR_DIG != '') {
                $resp[$key]->nameAsesor = $this->userInterface->getUserName($lead->ASESOR_DIG)->name;
            }

            $respChannel         = $this->leadInterface->getLeadChannel($lead->CEDULA);
            $resp[$key]->channel = $respChannel[0]->channel;
            $resp[$key]->id      = $respChannel[0]->id;
            $resp[$key]->state   = $respChannel[0]->state;
            $leadsDigital[]      = $resp[$key];
        }

        return [
            'leadsDigital' => $leadsDigital,
            'totalLeads'   => count($respTotalLeads)
        ];
    }

    private function getLeadsCM($request)
    {
        $queryCM = "SELECT lead.`id`, lead.`name`, lead.`lastName`, CONCAT(lead.`name`,' ',lead.`lastName`) as nameLast, lead.`email`, lead.`assessor_id`, lead.`telephone`, lead.`identificationNumber`, lead.`created_at`, lead.`city`, lead.`typeService`, lead.`typeProduct`, lead.`state`, lead.`channel`, lead.`campaign`, cam.`name` as campaignName, lead.`nearbyCity`
        FROM `leads` as lead
        LEFT JOIN `campaigns` as cam ON cam.id = lead.campaign
        WHERE (`channel` = 2 OR `channel` = 3 )";

        if ($request['q'] != '') {
            $queryCM .= sprintf(
                " AND (lead.`name` LIKE '%s' OR lead.`lastName` LIKE '%s' OR lead.`identificationNumber` LIKE '%s' OR lead.`telephone` LIKE '%s' )",
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%'
            );
        }

        if ($request['qcityAprobados'] != '') {
            $queryCM .= sprintf(" AND (lead.`city` = '%s') ", $request['qcityAprobados']);
        }

        if ($request['qleadChannel'] != '') {
            $queryCM .= sprintf(" AND (lead.`channel` = '%s') ", $request['qleadChannel']);
        }

        if ($request['qfechaInicialAprobados'] != '') {
            $request['qfechaInicialAprobados'] .= " 00:00:00";
            $queryCM .= sprintf(" AND (lead.`created_at` >= '%s') ", $request['qfechaInicialAprobados']);
        }

        if ($request['qfechaFinalAprobados'] != '') {
            $request['qfechaFinalAprobados'] .= " 23:59:59";
            $queryCM .= sprintf(" AND (lead.`created_at` <= '%s') ", $request['qfechaFinalAprobados']);
        }

        $respTotalLeadsCM = DB::select($queryCM);
        $queryCM .= "ORDER BY `created_at` DESC ";
        $queryCM .= sprintf(" LIMIT %s,30", $request['initFromCM']);
        $resp = DB::select($queryCM);


        $leadsCM = [];

        foreach ($resp as $key => $lead) {
            if ($lead->assessor_id != '') {
                $resp[$key]->nameAsesor = $this->userInterface->getUserName($lead->assessor_id)->name;
            }
            $leadsCM[]      = $resp[$key];
        }




        return [
            'leadsCM' =>  $leadsCM,
            'totalLeadsCM' => count($respTotalLeadsCM)
        ];
    }

    private function getLeadsTradicional($request)
    {
        $queryTradicional = "SELECT  cf.`NOMBRES`, cf.`APELLIDOS`, cf.`CELULAR`, cf.`EMAIL`, cf.`ESTADO`, cf.`CIUD_UBI`, cf.`CEDULA`, cf.`CREACION` as CREACION, cf.`ORIGEN`, cf.`PLACA`, score.`score`, TB_DEFINICIONES.`DESCRIPCION`, TB_INTENCIONES.FECHA_INTENCION
        FROM `CLIENTE_FAB` as cf, `cifin_score` as score, `TB_INTENCIONES`
        LEFT JOIN TB_DEFINICIONES ON TB_INTENCIONES.ID_DEF = TB_DEFINICIONES.ID_DEF
        where `TB_INTENCIONES`.`Tarjeta` = 'Crédito Tradicional'
        AND `TB_INTENCIONES`.`CEDULA` = cf.`CEDULA`
        AND score.`scocedula` = cf.`CEDULA`
        AND score.`scoconsul` = (SELECT MAX(`scoconsul`) FROM `cifin_score` WHERE `scocedula` = cf.`CEDULA` )
        AND cf.`CIUD_UBI` != 'BOGOTÁ'
        AND TB_INTENCIONES.FECHA_INTENCION = (SELECT MAX(`FECHA_INTENCION`) FROM `TB_INTENCIONES` WHERE `CEDULA` = `cf`.`CEDULA`)";

        if ($request['q'] != '') {
            $queryTradicional .= sprintf(
                " AND (cf.`NOMBRES` LIKE '%s' OR cf.`CEDULA` LIKE '%s' OR cf.`CELULAR` LIKE '%s' ) ",
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%'
            );
        }

        if ($request['qcityAprobados'] != '') {
            $queryTradicional .= sprintf(" AND (cf.`CIUD_UBI` = '%s') ", $request['qcityAprobados']);
        }

        if ($request['qfechaInicialTR'] != '') {
            $request['qfechaInicialTR'] .= " 00:00:00";
            $queryTradicional .= sprintf(" AND (TB_INTENCIONES.`FECHA_INTENCION` >= '%s') ", $request['qfechaInicialTR']);
        }

        if ($request['qfechaFinalTR'] != '') {
            $request['qfechaFinalTR'] .= " 23:59:59";
            $queryTradicional .= sprintf(" AND (TB_INTENCIONES.`FECHA_INTENCION` <= '%s') ", $request['qfechaFinalTR']);
        }

        $respTotalLeadsTradicional = DB::connection('oportudata')->select($queryTradicional);
        $queryTradicional .= "ORDER BY `FECHA_INTENCION` DESC ";
        $queryTradicional .= sprintf(" LIMIT %s,30", $request['initFromTR']);

        return [
            'leadsTR' => DB::connection('oportudata')->select($queryTradicional),
            'totalLeadsTR' => count($respTotalLeadsTradicional)
        ];
    }

    private function getGenLeads($request)
    {
        $queryGenLeads = "SELECT lead.`id`, lead.`name`, lead.`lastName`, CONCAT(lead.`name`,' ',lead.`lastName`) as nameLast, lead.`email`, lead.`telephone`, lead.`identificationNumber`, lead.`created_at`, lead.`city`, lead.`typeService`, lead.`state`, lead.`channel`, lead.`nearbyCity`
        FROM `leads` as lead
        WHERE `typeService` IN  ('Motos','Seguros')
        AND lead.`state` !=  3 ";

        if ($request['q'] != '') {
            $queryGenLeads .= sprintf(
                " AND (lead.`name` LIKE '%s' OR lead.`typeService` LIKE '%s' OR lead.`telephone` LIKE '%s' ) ",
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%',
                '%' . $request['q'] . '%'
            );
        }

        if ($request['qcityAprobados'] != '') {
            $queryGenLeads .= sprintf(" AND (lead.`city` = '%s') ", $request['qcityAprobados']);
        }

        if ($request['qfechaInicialAprobados'] != '') {
            $request['qfechaInicialAprobados'] .= " 00:00:00";
            $queryGenLeads .= sprintf(" AND (lead.`created_at` >= '%s') ", $request['qfechaInicialAprobados']);
        }

        if ($request['qfechaFinalAprobados'] != '') {
            $request['qfechaFinalAprobados'] .= " 23:59:59";
            $queryGenLeads .= sprintf(" AND (lead.`created_at` <= '%s') ", $request['qfechaFinalAprobados']);
        }

        $respTotalLeadsGen = DB::select($queryGenLeads);
        $queryGenLeads .= "ORDER BY `created_at` DESC ";
        $queryGenLeads .= sprintf(" LIMIT %s,30", $request['initFromGen']);

        return [
            'leadsGen'      => DB::select($queryGenLeads),
            'totalLeadsGen' => count($respTotalLeadsGen)
        ];
    }

    public function checkLeadProcess($idLead)
    {
        if ($idLead == '') return -1;
        $lead = $this->leadInterface->findLeadById($idLead);
        $lead->state = 2;
        return response()->json($lead->save());
    }

    public function show($id)
    {
        $leads = $this->leadInterface->findLeadById($id);
        $leadsQuery = Lead::selectRaw('leads.*,liquidator.*')
            ->leftjoin('liquidator', 'leads.id', '=', 'liquidator.idLead')
            ->where('leads.id', '=', $leads->id)
            ->orderBy('leads.id')
            ->get();

        return view('leads.show', [
            'leads'      => $leads,
            'leadsQuery' => $leadsQuery
        ]);
    }

    public function addCommunityLeads(Request $request)
    {
        $idCampaign =  $this->campaignInterface->findCampaignByName($request->get('campaign'));
        $idCampaign = (count($idCampaign) > 0) ? $idCampaign[0]->id : NULL;
        $request['termsAndConditions'] = 2;
        $request['campaign'] = $idCampaign;

        return response()->json($this->leadInterface->createLead($request->input()));
    }

    public function viewCommunityLeads($id)
    {
        return response()->json($this->leadInterface->findLeadById($id));
    }

    public function deleteCommunityLeads($id)
    {
        $lead = $this->leadInterface->findLeadById($id);
        $lead->delete(); 

        return response()->json([true]);
    }

    public function updateCommunityLeads(Request $request)
    {
        $nameCampaign = (string) $request->get('campaignName');
        $leadRerpo = new leadRepository($this->leadInterface->findLeadById($request->get('id')));

        if ($nameCampaign) {
            $idCampaign =  $this->campaignInterface->findCampaignByName($nameCampaign);
            $idCampaign = $idCampaign->id;
            $request['campaign'] = $idCampaign;
        }

        $leadRerpo->updateLead($request->input());

        return response()->json([true]);
    }

    public function getComentsLeads($idLead)
    {
        return  $this->leadInterface->findLeadById($idLead)->comments;
    }

    public function deniedRequest($idLead, $comment)
    {
        $lead =  $this->leadInterface->findLeadById($idLead);
        $lead->state = 4;
        $lead->save();
        $this->addComent($idLead, $comment);

        return response()->json([true]);
    }

    public function assignAssesorDigitalToLeadCM($id)
    {
        $lead = $this->leadInterface->findLeadById($id);
        $lead->assessor_id = auth()->user()->id;
        return response()->json($lead->save());
    }
}
