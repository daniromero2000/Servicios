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
        $this->IdEmpresa = $this->assessorInterface->getAssessorCompany($this->codeAsessor);
        $getLeadsTR = $this->getLeadsTradicional([
            'q'               => $request->get('q'),
            'initFromTR'      => $request->get('initFromTR'),
            'qfechaInicialTR' => $request->get('qfechaInicialTR'),
            'qfechaFinalTR'   => $request->get('qfechaFinalTR'),
            'qOrigenTR'       => $request->get('qOrigenTR'),
            'qcityAprobados'  => $request->get('qcityAprobados')
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

        return response()->json([

            'leadsDigital'    => $getLeadsDigital['leadsDigital'],
            'totalLeads'      => $getLeadsDigital['totalLeads'],

            'codeAsesor'      => $this->codeAsessor,
            'leadsTR'         => $getLeadsTR['leadsTR'],
            'totalLeadsTR'    => $getLeadsTR['totalLeadsTR'],
        ]);
    }


    private function getLeadsCanalDigital($request)
    {
        ini_set('memory_limit', "512M");

        $query = sprintf("SELECT
        	cf.NOMBRES,
        	cf.APELLIDOS,
        	cf.CELULAR,
        	cf.CIUD_UBI,
        	cf.CEDULA,
        	cf.ORIGEN,
        	sb.SOLICITUD,
        	sb.ASESOR_DIG,
        	sb.SUCURSAL,
        	ti.TARJETA,
        	sb.FECHASOL,
        	productsv2.sku,
        	productsv2.`NAME` 
        FROM
        	CLIENTE_FAB AS cf
        	LEFT JOIN SOLIC_FAB AS sb ON cf.CEDULA = sb.CLIENTE
        	LEFT JOIN TB_INTENCIONES AS ti ON cf.CEDULA = ti.CEDULA
        	LEFT JOIN productsv2 ON ti.product_id = productsv2.id
        WHERE
        	( cf.ESTADO = 'APROBADO' OR cf.ESTADO = 'PREAPROBADO' ) 
	        AND sb.ESTADO = 19 
	        AND sb.STATE = 'A' 
	        AND sb.SOLICITUD_WEB >= 1 
	        AND sb.ASESOR_DIG IS NULL 
	        AND ti.deleted_at IS NULL 
	        AND ( ti.ASESOR = 998877 OR ti.ASESOR = 1088315168 OR ti.ASESOR = 1088308622 ) 
	        AND ti.FECHA_INTENCION = ( SELECT MAX( `FECHA_INTENCION` ) FROM `TB_INTENCIONES` WHERE `CEDULA` = `cf`.`CEDULA` )
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

        if ($request['qOrigenAprobados'] != '') {
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

            $leadsDigital[]      = $resp[$key];
        }

        return [
            'leadsDigital' => $leadsDigital,
            'totalLeads'   => count($respTotalLeads)
        ];
    }

    private function getLeadsTradicional($request)
    {

        ini_set('memory_limit', "512M");

        $queryTradicional = "SELECT
    cf.`NOMBRES`,
    cf.`APELLIDOS`,
    cf.`CELULAR`,
    cf.`EMAIL`,
    cf.`CIUD_UBI`,
    TB_INTENCIONES.`CEDULA`,
    cf.`ORIGEN`,
    cf.`PLACA`,
    TB_DEFINICIONES.`DESCRIPCION`,
    TB_INTENCIONES.`PERFIL_CREDITICIO`,
    TB_INTENCIONES.FECHA_INTENCION,
    productsv2.sku,
    productsv2.name
FROM
    CLIENTE_FAB AS cf,
    TB_INTENCIONES
        LEFT JOIN
    TB_DEFINICIONES ON TB_INTENCIONES.ID_DEF = TB_DEFINICIONES.id
        LEFT JOIN
    productsv2 ON `TB_INTENCIONES`.product_id = productsv2.id
        LEFT JOIN
    SOLIC_FAB ON TB_INTENCIONES.CEDULA = SOLIC_FAB.CLIENTE
WHERE
    TB_INTENCIONES.FECHA_INTENCION = (SELECT
            MAX(`FECHA_INTENCION`)
        FROM
            `TB_INTENCIONES`
        WHERE
            `CEDULA` = `cf`.`CEDULA`)
        AND TB_INTENCIONES.CREDIT_DECISION IS NULL
        AND `TB_INTENCIONES`.`deleted_at` IS NULL
        AND `TB_INTENCIONES`.`Tarjeta` = 'Crédito Tradicional'
        AND `TB_INTENCIONES`.`CEDULA` = cf.`CEDULA`
        AND (`TB_INTENCIONES`.`ASESOR` = 998877
        OR `TB_INTENCIONES`.`ASESOR` = 1088315168
        OR `TB_INTENCIONES`.`ASESOR` = 1088308622)
        AND (SOLIC_FAB.ESTADO = 1
        OR SOLIC_FAB.ESTADO = 19
        OR SOLIC_FAB.ESTADO = 20
        OR SOLIC_FAB.ESTADO IS NULL)
        AND cf.`CIUD_UBI` != 'BOGOTÁ'";

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

        if ($request['qOrigenTR'] != '') {
            $queryTradicional .= sprintf(" AND (cf.`ORIGEN` = '%s') ", $request['qOrigenTR']);
        }

        $respTotalLeadsTradicional = DB::connection('oportudata')->select($queryTradicional);
        $queryTradicional .= "ORDER BY `FECHA_INTENCION` DESC ";
        $queryTradicional .= sprintf(" LIMIT %s,30", $request['initFromTR']);

        return [
            'leadsTR' => DB::connection('oportudata')->select($queryTradicional),
            'totalLeadsTR' => count($respTotalLeadsTradicional)
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
        $request['state'] = 8;
        $request['campaign'] = $idCampaign;
        $dataOportudata = [
            'TIPO_DOC' => 1,
            'CEDULA' => $request->input('identificationNumber'),
            'APELLIDOS' => $request->input('lastName'),
            'NOMBRES' => $request->input('name'),
            'TIPOCLIENTE' => 'NUEVO',
            'SUBTIPO' => 'WEB',
            'CELULAR' => $request->input('telephone'),
            'CIUD_UBI' => $request->input('city'),
            'EMAIL' => $request->input('email'),
            'MIGRADO' => 1,
            'SUC' => 9999,
            'ORIGEN' => 'Canal Digital',
            'CLIENTE_WEB' => 1
        ];
        $customer = $this->customerInterface->checkIfExists($request->input('identificationNumber'));
        if (empty($customer)) {
            $this->customerInterface->updateOrCreateCustomer($dataOportudata);
        }

        $lead =  $this->leadInterface->createLead($request->input());
        $lead->leadStatus()->attach($request['state'], ['user_id' => auth()->user()->id]);
        if (!empty($request['assessor_id'])) {
            $lead->leadStatus()->attach(3, ['user_id' => auth()->user()->id]);
            $lead['STATE'] = 3;
            $lead->save();
        }
        return response()->json($lead);
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
        $lead = $this->leadInterface->findLeadById($request->get('id'));

        if ($lead->state != $request['state']) {
            $lead->state = $request['state'];
            $lead->leadStatus()->attach($request['state'], ['user_id' => auth()->user()->id]);
        }

        $leadRerpo = new leadRepository($lead);

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

    public function getFactoryRequestComments($solicitud)
    {
        return $this->factoryRequestInterface->findFactoryRequestById($solicitud)->comments;
    }

    public function getCustomerComments($id)
    {
        return $this->customerInterface->findCustomerCommentsById($id)->customerComments;
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
