<?php

namespace App\Http\Controllers\Admin\DigitalChannelLeads;

use App\Entities\LeadPrices\LeadPrice;
use App\Entities\Campaigns\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Entities\Channels\Repositories\Interfaces\ChannelRepositoryInterface;
use App\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\LeadPriceStatuses\LeadPriceStatus;
use App\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Services\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Leads\Repositories\LeadRepository;
use App\Entities\Leads\Requests\CreateLeadRequest;

use App\Entities\LeadPrices\Repositories\Interfaces\LeadPriceRepositoryInterface;

class DigitalChannelLeadController extends Controller
{
    private $LeadStatusesInterface, $leadInterface, $toolsInterface, $subsidiaryInterface;
    private $channelInterface, $serviceInterface, $campaignInterface, $customerInterface;
    private $leadProductInterface;

    public function __construct(
        LeadRepositoryInterface $LeadRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        ChannelRepositoryInterface $channelRepositoryInterface,
        ServiceRepositoryInterface $serviceRepositoryInterface,
        CampaignRepositoryInterface $campaignRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        LeadProductRepositoryInterface $leadProductRepositoryInterface,
        LeadStatusRepositoryInterface $leadStatusRepositoryInterface,
        LeadPriceRepositoryInterface $LeadPriceRepositoryInterface
    ) {
        $this->leadInterface         = $LeadRepositoryInterface;
        $this->toolsInterface        = $toolRepositoryInterface;
        $this->subsidiaryInterface   = $subsidiaryRepositoryInterface;
        $this->channelInterface      = $channelRepositoryInterface;
        $this->serviceInterface      = $serviceRepositoryInterface;
        $this->campaignInterface     = $campaignRepositoryInterface;
        $this->customerInterface     = $customerRepositoryInterface;
        $this->leadProductInterface  = $leadProductRepositoryInterface;
        $this->LeadStatusesInterface = $leadStatusRepositoryInterface;
        $this->LeadPriceInterface = $LeadPriceRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->leadInterface->listLeads($skip * 30);
        if (request()->has('q')) {
            $list = $this->leadInterface->searchLeads(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('state'),
                request()->input('assessor_id'),
                request()->input('city')
            );
        }
        $listCount = $list->count();

        $pricesTotal = 0;
        foreach ($list as $key => $status) {
            $pricesTotal +=  $list[$key]->leadPrices->sum('lead_price');
        }

        return view('digitalchannelleads.list', [
            'pricesTotal'         => $pricesTotal,
            'digitalChannelLeads' => $list,
            'optionsRoutes'       => (request()->segment(2)),
            'headers'             => ['', 'Estado', 'Lead', 'Asesor', 'Nombre', 'Celular', 'Ciudad', 'Servicio', 'Producto', 'Fecha', 'Acciones'],
            'listCount'           => $listCount,
            'skip'                => $skip,
            'cities'              => $this->subsidiaryInterface->getAllSubsidiaryCityNames(),
            'channels'            => $this->channelInterface->getAllChannelNames(),
            'services'            => $this->serviceInterface->getAllServiceNames(),
            'campaigns'           => $this->campaignInterface->getAllCampaignNames(),
            'lead_products'       => $this->leadProductInterface->getAllLeadProductNames(),
            'lead_statuses'       => $this->LeadStatusesInterface->getAllLeadStatusesNames(),
        ]);
    }

    public function store(CreateLeadRequest $request)
    {

        $request['identificationNumber'] = (!empty($request->input('identificationNumber'))) ? $request->input('identificationNumber') : 'N/A';
        $request['telephone'] = (!empty($request->input('telephone'))) ? $request->input('telephone') : 'N/A';

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

        $lead =  $this->leadInterface->createLead($request->input());
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
        $digitalChannelLead =  $this->leadInterface->findLeadByIdFull($id);
        $pattern = ['/[\\+][0-9]{0,2}\s[0-9]{0,3}\s[0-9]{0,7}/', '/[\\[]/'];
        //$pattern = '/[\\+][\\5][\\7]\s[0-9]{0,3}\s[0-9]{0,7}/';
        $replace = ['Cliente', PHP_EOL . '['];
        foreach ($digitalChannelLead->comments as $key => $value) {
            $digitalChannelLead->comments[$key]->comment = preg_replace($pattern, $replace, $digitalChannelLead->comments[$key]->comment);
        }
        $leadPriceStatus = LeadPriceStatus::all();
        return view('digitalchannelleads.show', [
            'digitalChannelLead' => $digitalChannelLead,
            'leadCity'           => $digitalChannelLead->city,
            'leadChannel'        => $digitalChannelLead->channel,
            'leadCampaign'       => $digitalChannelLead->campaign,
            'leadService'        => $digitalChannelLead->typeService,
            'leadProduct'        => $digitalChannelLead->typeProduct,
            'leadStatus'         => $digitalChannelLead->state,
            'cities'             => $this->subsidiaryInterface->getAllSubsidiaryCityNames(),
            'channels'           => $this->channelInterface->getAllChannelNames(),
            'services'           => $this->serviceInterface->getAllServiceNames(),
            'campaigns'          => $this->campaignInterface->getAllCampaignNames(),
            'lead_products'      => $this->leadProductInterface->getAllLeadProductNames(),
            'lead_statuses'      => $this->LeadStatusesInterface->getAllLeadStatusesNames(),
            'leadPriceStatus'    => $leadPriceStatus
        ]);
    }

    public function update(Request $request, $id)
    {
        $lead = $this->leadInterface->findLeadById($id);
        if ($lead->state != $request['state']) {
            $lead->state = $request['state'];
            $lead->leadStatus()->attach($request['state'], ['user_id' => auth()->user()->id]);
        }
        $leadRerpo = new leadRepository($lead);
        $leadRerpo->updateLead($request->input());
        $request->session()->flash('message', 'Actualización Exitosa!');
        return redirect()->back();
    }

    public function dashboard(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->subMonth();

        $leadChannels = $this->leadInterface->countLeadChannels($from, $to);
        $leadStatuses = $this->leadInterface->countLeadStatuses($from, $to);
        $leadAssessors = $this->leadInterface->countLeadAssessors($from, $to);
        $leadProducts = $this->leadInterface->countLeadProducts($from, $to);
        $leadServices = $this->leadInterface->countLeadServices($from, $to);
        $leadPriceTotal = $this->leadInterface->getLeadPriceTotal($from, $to);
        $leadPrice = $this->LeadPriceInterface->getPriceDigitalChanel($from, $to, 1);


        if (request()->has('from')) {
            $leadChannels = $this->leadInterface->countLeadChannels(request()->input('from'), request()->input('to'));
            $leadStatuses = $this->leadInterface->countLeadStatuses(request()->input('from'), request()->input('to'));
            $leadAssessors = $this->leadInterface->countLeadAssessors(request()->input('from'), request()->input('to'));
            $leadProducts = $this->leadInterface->countLeadProducts(request()->input('from'), request()->input('to'));
            $leadServices = $this->leadInterface->countLeadServices(request()->input('from'), request()->input('to'));
            $leadPriceTotal = $this->leadInterface->getLeadPriceTotal(request()->input('from'), request()->input('to'));
            $leadPrice = $this->LeadPriceInterface->getPriceDigitalChanel(request()->input('from'), request()->input('to'), 1);
        }

        foreach ($leadChannels as $key => $status) {
            $option = ($key == '') ? 'Sin Canal' : $key;
            $leadChannels[] = ['channel' => $option, 'total' => count($leadChannels[$key])];
            unset($leadChannels[$key]);
        }

        foreach ($leadStatuses as $key => $status) {
            $option = ($key == '') ? 'Sin Estado' : $key;
            $leadStatuses[] = ['status' => $option, 'total' => count($leadStatuses[$key])];
            unset($leadStatuses[$key]);
        }

        foreach ($leadAssessors as $key => $status) {
            $option = ($key == '') ? 'Sin Asesor' : $key;
            $leadAssessors[] = ['assessor' => $option, 'total' => count($leadAssessors[$key])];
            unset($leadAssessors[$key]);
        }

        foreach ($leadProducts as $key => $status) {
            $option = ($key == '') ? 'Sin Producto' : $key;
            $leadProducts[] = ['product' => $option, 'total' => count($leadProducts[$key])];
            unset($leadProducts[$key]);
        }

        foreach ($leadServices as $key => $status) {
            $option = ($key == '') ? 'Sin Servicio' : $key;
            $leadServices[] = ['service' => $option, 'total' => count($leadServices[$key])];
            unset($leadServices[$key]);
        }

        $totalStatuses = $leadChannels->sum('total');
        $leadChannels = $this->toolsInterface->extractValuesToArray($leadChannels);
        $leadStatuses    = $this->toolsInterface->extractValuesToArray($leadStatuses);
        $leadAssessors    = $this->toolsInterface->extractValuesToArray($leadAssessors);
        $leadProducts    = $this->toolsInterface->extractValuesToArray($leadProducts);
        $leadServices    = $this->toolsInterface->extractValuesToArray($leadServices);

        $leadChannelNames  = [];
        $leadChannelValues  = [];
        foreach ($leadChannels as $leadChannel) {
            array_push($leadChannelNames, trim($leadChannel['channel']));
            array_push($leadChannelValues, trim($leadChannel['total']));
        }

        $leadStatusesNames  = [];
        $leadStatusesValues  = [];
        foreach ($leadStatuses as $leadStatus) {
            array_push($leadStatusesNames, trim($leadStatus['status']));
            array_push($leadStatusesValues, trim($leadStatus['total']));
        }

        $leadAssessorsNames  = [];
        $leadAssessorsValues  = [];
        foreach ($leadAssessors as $leadAssessor) {
            array_push($leadAssessorsNames, trim($leadAssessor['assessor']));
            array_push($leadAssessorsValues, trim($leadAssessor['total']));
        }
        $leadProductsNames  = [];
        $leadProductsValues  = [];
        foreach ($leadProducts as $leadProduct) {
            array_push($leadProductsNames, trim($leadProduct['product']));
            array_push($leadProductsValues, trim($leadProduct['total']));
        }

        $leadServicesNames  = [];
        $leadServicesValues  = [];
        foreach ($leadServices as $leadService) {
            array_push($leadServicesNames, trim($leadService['service']));
            array_push($leadServicesValues, trim($leadService['total']));
        }

        $leadpriceTotal = $leadPrice->sum('lead_price');

        $pricesTotal = 0;
        foreach ($leadPriceTotal as $key => $status) {
            $pricesTotal +=  $leadPriceTotal[$key]->leadPrices->sum('lead_price');
        }


        return view('digitalchannelleads.dashboard', [
            'pricesTotal'         => $pricesTotal,
            'leadChannelNames'    => $leadChannelNames,
            'leadChannelValues'   => $leadChannelValues,
            'leadStatusesNames'   => $leadStatusesNames,
            'leadStatusesValues'  => $leadStatusesValues,
            'leadAssessorsNames'  => $leadAssessorsNames,
            'leadAssessorsValues' => $leadAssessorsValues,
            'leadProductsNames'   => $leadProductsNames,
            'leadProductsValues'  => $leadProductsValues,
            'leadServicesNames'   => $leadServicesNames,
            'leadServicesValues'  => $leadServicesValues,
            'totalStatuses'       => $totalStatuses,
            'leadpriceTotal'      =>  $leadpriceTotal
        ]);
    }
    public function destroy($id)
    {
        // $Campaign = Campaigns::findOrfail($id);
        $digitalChannelLead =  $this->leadInterface->findLeadDelete($id);
        $digitalChannelLead->delete();
        return redirect()->back();
    }
}