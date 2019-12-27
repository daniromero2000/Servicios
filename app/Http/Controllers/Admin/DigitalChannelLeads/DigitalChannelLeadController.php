<?php

namespace App\Http\Controllers\Admin\DigitalChannelLeads;

use App\Entities\Campaigns\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Entities\Channels\Repositories\Interfaces\ChannelRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Services\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Leads\Repositories\LeadRepository;

class DigitalChannelLeadController extends Controller
{
    private $LeadStatusesInterface, $LeadInterface, $toolsInterface, $subsidiaryInterface;
    private $channelInterface, $serviceInterface, $campaignInterface, $customerInterface;

    public function __construct(
        LeadRepositoryInterface $LeadRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        ChannelRepositoryInterface $channelRepositoryInterface,
        ServiceRepositoryInterface $serviceRepositoryInterface,
        CampaignRepositoryInterface $campaignRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->LeadInterface = $LeadRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->channelInterface = $channelRepositoryInterface;
        $this->serviceInterface = $serviceRepositoryInterface;
        $this->campaignInterface = $campaignRepositoryInterface;
        $this->customerInterface = $customerRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->LeadInterface->listLeads($skip * 30);
        if (request()->has('q')) {
            $list = $this->LeadInterface->searchLeads(request()->input('q'), $skip, request()->input('from'), request()->input('to'), request()->input('creditprofile'), request()->input('status'))->sortByDesc('FECHA_INTENCION');
        }
        $listCount = $list->count();

        return view('digitalchannelleads.list', [
            'digitalChannelLeads'            => $list,
            'optionsRoutes'        => (request()->segment(2)),
            'headers'              => ['', 'Estado', 'Lead', 'Asesor', 'Cedula',  'Nombre',  'Correo', 'Celular', 'Ciudad', 'Servicio', 'Producto', 'Fecha', 'Acciones'],
            'listCount'            => $listCount,
            'skip'                 => $skip,
            'cities' => $this->subsidiaryInterface->getAllSubsidiaryCityNames(),
            'channels' => $this->channelInterface->getAllChannelNames(),
            'services' => $this->serviceInterface->getAllServiceNames(),
            'campaigns' => $this->campaignInterface->getAllCampaignNames()
        ]);
    }

    public function store(Request $request)
    {
        $request['termsAndConditions'] = 2;
        $request['state'] = 8;
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

        $lead =  $this->LeadInterface->createLead($request->input());
        $lead->leadStatus()->attach($request['state'], ['user_id' => auth()->user()->id]);
        if (!empty($request['assessor_id'])) {
            $lead->leadStatus()->attach(3, ['user_id' => auth()->user()->id]);
            $lead['STATE'] = 3;
            $lead->save();
        }

        $request->session()->flash('message', 'Creación de Lead Exitosa!');
        return redirect()->back();
    }

    public function show(int $id)
    {
        $digitalChannelLead =  $this->LeadInterface->findLeadByIdFull($id);

        return view('digitalchannelleads.show', [
            'digitalChannelLead' => $digitalChannelLead,
            'leadCity'           => $digitalChannelLead->city,
            'leadChannel'        => $digitalChannelLead->channel,
            'cities'             => $this->subsidiaryInterface->getAllSubsidiaryCityNames(),
            'channels'           => $this->channelInterface->getAllChannelNames(),
            'services'           => $this->serviceInterface->getAllServiceNames(),
            'campaigns'          => $this->campaignInterface->getAllCampaignNames()
        ]);
    }


    public function update(Request $request, $id)
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
        $request->session()->flash('message', 'Actualización Exitosa!');
        return redirect()->route('admin.customers.show', $id);
    }

    public function dashboard(Request $request)
    {
        $to   = Carbon::now();
        $from = Carbon::now()->subMonth();

        $creditProfiles    = $this->LeadInterface->countLeadsCreditProfiles($from, $to);
        $creditCards       = $this->LeadInterface->countLeadsCreditCards($from, $to);
        $LeadStatuses = $this->LeadInterface->countLeadsStatuses($from, $to);

        if (request()->has('from')) {
            $creditProfiles    = $this->LeadInterface->countLeadsCreditProfiles(request()->input('from'), request()->input('to'));
            $creditCards       = $this->LeadInterface->countLeadsCreditCards(request()->input('from'), request()->input('to'));
            $LeadStatuses = $this->LeadInterface->countLeadsStatuses(request()->input('from'), request()->input('to'));
        }

        $LeadStatusesNames  = [];
        $LeadStatusesValues = [];

        foreach ($LeadStatuses as $LeadStatus) {
            array_push($LeadStatusesNames, trim($LeadStatus->LeadStatus['NAME']));
            array_push($LeadStatusesValues, trim($LeadStatus['total']));
        }

        $creditCards = $this->toolsInterface->getDataPercentage($creditCards);

        $statusPercentage = [];
        $totalStatuses    = $creditCards->sum('total');
        foreach ($LeadStatuses as $key => $value) {
            $statusPercentage[$key]['status']     = $value->LeadStatus['NAME'];
            $statusPercentage[$key]['percentage'] = ($value['total'] / $totalStatuses) * 100;
        }

        $creditProfiles = $this->toolsInterface->extractValuesToArray($creditProfiles);
        $creditCards    = $this->toolsInterface->extractValuesToArray($creditCards);

        $creditProfilesNames  = [];
        $creditProfilesValues = [];

        foreach ($creditProfiles as $creditProfile) {
            array_push($creditProfilesNames, trim($creditProfile['PERFIL_CREDITICIO']));
            array_push($creditProfilesValues, trim($creditProfile['total']));
        }

        return view('Leads.dashboard', [
            'creditProfilesNames'     => $creditProfilesNames,
            'creditProfilesValues'    => $creditProfilesValues,
            'LeadStatusesNames'  => $LeadStatusesNames,
            'LeadStatusesValues' => $LeadStatusesValues,
            'creditCards'             => $creditCards,
            'statusPercentage'        => $statusPercentage,
            'totalStatuses'           => array_sum($creditProfilesValues),
        ]);
    }
}
