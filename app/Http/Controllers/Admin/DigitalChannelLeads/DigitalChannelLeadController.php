<?php

namespace App\Http\Controllers\Admin\DigitalChannelLeads;

use App\Entities\Campaigns\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Entities\Channels\Repositories\Interfaces\ChannelRepositoryInterface;
use App\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\LeadAreas\LeadArea;
use App\Entities\LeadAreas\Repositories\LeadAreaRepository;
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
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Entities\AssessorQuotations\Repositories\Interfaces\AssessorQuotationRepositoryInterface;
use App\Entities\LeadPrices\Repositories\Interfaces\LeadPriceRepositoryInterface;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Entities\OportudataLogs\OportudataLog;
use App\Events\LeadNotification;
use App\Liquidator;
use App\Entities\Assessors\Repositories\Interfaces\AssessorRepositoryInterface;

class DigitalChannelLeadController extends Controller
{
    private $LeadStatusesInterface, $leadInterface, $toolsInterface, $subsidiaryInterface;
    private $channelInterface, $serviceInterface, $campaignInterface, $customerInterface;
    private $leadProductInterface, $UserInterface, $LeadPriceInterface, $assessorInterface, $assessorQuotationInterface;

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
        LeadPriceRepositoryInterface $LeadPriceRepositoryInterface,
        UserRepositoryInterface $UserRepositoryInterface,
        LeadAreaRepository $LeadAreaRepositoryInterface,
        CityRepositoryInterface $CityRepositoryInterface,
        AssessorQuotationRepositoryInterface $assessorQuotationRepositoryInterface,
        AssessorRepositoryInterface $AssessorRepositoryInterface
    ) {
        $this->leadInterface              = $LeadRepositoryInterface;
        $this->toolsInterface             = $toolRepositoryInterface;
        $this->subsidiaryInterface        = $subsidiaryRepositoryInterface;
        $this->channelInterface           = $channelRepositoryInterface;
        $this->serviceInterface           = $serviceRepositoryInterface;
        $this->campaignInterface          = $campaignRepositoryInterface;
        $this->customerInterface          = $customerRepositoryInterface;
        $this->leadProductInterface       = $leadProductRepositoryInterface;
        $this->LeadStatusesInterface      = $leadStatusRepositoryInterface;
        $this->LeadPriceInterface         = $LeadPriceRepositoryInterface;
        $this->UserInterface              = $UserRepositoryInterface;
        $this->LeadAreaInterface          = $LeadAreaRepositoryInterface;
        $this->cityInterface              = $CityRepositoryInterface;
        $this->assessorInterface          = $AssessorRepositoryInterface;
        $this->assessorQuotationInterface = $assessorQuotationRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $to                 = Carbon::now();
        $from               = Carbon::now()->startOfMonth();
        $skip               = $this->toolsInterface->getSkip($request->input('skip'));
        $list               = $this->leadInterface->listLeads($skip * 30);
        $leadsOfMonth       = $this->leadInterface->countLeadTotal($from, $to);
        $leadPriceTotalSold = $this->LeadPriceInterface->getLeadPriceTotal($from, $to);
        $leadsOfMonthTotal  = 0;
        $leadsOfMonthTotal  = $leadPriceTotalSold->sum('lead_price');
        if (request()->has('q')) {
            $list = $this->leadInterface->searchLeads(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('state'),
                request()->input('assessor_id'),
                request()->input('channel'),
                request()->input('city'),
                request()->input('lead_area_id'),
                request()->input('typeService'),
                request()->input('typeProduct'),
                request()->input('subsidiary_id')
            );
            $leadsOfMonth = $this->leadInterface->searchLeads(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('state'),
                request()->input('assessor_id'),
                request()->input('channel'),
                request()->input('city'),
                request()->input('lead_area_id'),
                request()->input('typeService'),
                request()->input('typeProduct'),
                request()->input('subsidiary_id')
            );
            foreach ($leadsOfMonth as $key => $status) {
                $leadsOfMonthTotal +=  $leadsOfMonth[$key]->leadPrices->sum('lead_price');
            }
        }

        $listCount    = $list->count();
        $leadsOfMonth = $leadsOfMonth->count();
        $profile      = 2;
        $subsidary   = $this->subsidiaryInterface->getSubsidiares();

        return view('digitalchannelleads.list', [
            'leadsOfMonthTotal'   => $leadsOfMonthTotal,
            'leadsOfMonth'        => $leadsOfMonth,
            'digitalChannelLeads' => $list,
            'optionsRoutes'       => (request()->segment(2)),
            'headers'             => ['', 'Estado', 'Lead', 'Asesor', 'Sucursal', 'Nombre',  'Celular', 'Ciudad', 'Canal', 'Area', 'Servicio', 'Producto', 'Fecha', 'Acciones'],
            'listCount'           => $listCount,
            'skip'                => $skip,
            'areas'               => $this->LeadAreaInterface->getLeadAreaDigitalChanel(),
            'cities'              => $this->cityInterface->getCityByLabel(),
            'channels'            => $this->channelInterface->getAllChannelNames(),
            'services'            => $this->serviceInterface->getAllServiceNames(),
            'campaigns'           => $this->campaignInterface->getAllCampaignNames(),
            'lead_products'       => $this->leadProductInterface->getAllLeadProductNames(),
            'lead_statuses'       => $this->LeadStatusesInterface->getAllLeadStatusesNames(),
            'listAssessors'       => $this->UserInterface->listUser($profile),
            'subsidaries'         => $subsidary
        ]);
    }
    public function store(Request $request)
    {
        $request['identificationNumber'] = (!empty($request->input('identificationNumber'))) ? $request->input('identificationNumber') : '0';
        $request['telephone'] = (!empty($request->input('telephone'))) ? $request->input('telephone') : 'N/A';
        $request['termsAndConditions'] = 2;
        $request['state'] = 8;


        $lead =  $this->leadInterface->createLead($request->input());
        $lead->leadStatus()->attach($request['state'], ['user_id' => auth()->user()->id]);
        if (!empty($request['assessor_id'])) {
            $lead->leadStatus()->attach(3, ['user_id' => auth()->user()->id]);
            $lead['STATE'] = 3;
            $lead->save();
        }

        event(new LeadNotification($lead));

        $request->session()->flash('message', 'Creación de Lead Exitosa!');
        return redirect()->back();
    }

    public function show(int $id)
    {
        $digitalChannelLead =  $this->leadInterface->findLeadByIdFull($id);
        $pattern = ['/[\\+][0-9]{0,2}\s[0-9]{0,3}\s[0-9]{0,7}/', '/[\\[]/'];
        $replace = ['Cliente', PHP_EOL . '['];
        foreach ($digitalChannelLead->comments as $key => $value) {
            $digitalChannelLead->comments[$key]->comment = preg_replace($pattern, $replace, $digitalChannelLead->comments[$key]->comment);
        }
        $leadPriceStatus = LeadPriceStatus::all();

        $subsidary   = $this->subsidiaryInterface->getSubsidiares();

        $liquidators = Liquidator::selectRaw('pagaduria.name as pagaduriaName,libranza_profiles.name as customerType, libranza_lines.name as creditLineName , liquidator.age, liquidator.creditLine,liquidator.pagaduria,liquidator.fee,liquidator.rate , liquidator.salary, liquidator.amount , liquidator.timeLimit, leads.id,leads.identificationNumber,leads.name ,leads.lastName ,leads.email ,leads.telephone ,leads.city ,leads.typeService ,leads.typeProduct ,leads.state ,leads.channel ,leads.created_at ,leads.termsAndConditions ,leads.typeDocument ,leads.identificationNumber ,leads.occupation')
            ->leftJoin('leads', 'liquidator.idLead', '=', 'leads.id')
            ->leftJoin('pagaduria', 'liquidator.idPagaduria', '=', 'pagaduria.id')
            ->leftJoin('libranza_lines', 'liquidator.idCreditLine', '=', 'libranza_lines.id')
            ->leftJoin('libranza_profiles', 'liquidator.customerType', '=', 'libranza_profiles.id')
            ->where('leads.id', '=', $id)
            ->where('leads.typeService', '=', 14)->get();

        return view('digitalchannelleads.show', [
            'digitalChannelLead' => $digitalChannelLead,
            'leadCity'           => $digitalChannelLead->city,
            'leadChannel'        => $digitalChannelLead->channel,
            'leadCampaign'       => $digitalChannelLead->campaign,
            'leadService'        => $digitalChannelLead->typeService,
            'leadProduct'        => $digitalChannelLead->typeProduct,
            'leadStatus'         => $digitalChannelLead->state,
            'areas'              => $this->LeadAreaInterface->getLeadAreaDigitalChanel(),
            'cities'             => $this->cityInterface->getCityByLabel(),
            'channels'           => $this->channelInterface->getAllChannelNames(),
            'services'           => $this->serviceInterface->getAllServiceNames(),
            'campaigns'          => $this->campaignInterface->getAllCampaignNames(),
            'lead_products'      => $this->leadProductInterface->getAllLeadProductNames(),
            'lead_statuses'      => $this->LeadStatusesInterface->getAllLeadStatusesNames(),
            'product_quotations' => auth()->user()->leadArea->leadProduct,
            'leadPriceStatus'    => $leadPriceStatus,
            'liquidators'        => $liquidators,
            'subsidaries'        => $subsidary
        ]);
    }

    public function update(Request $request, $id)
    {
        $request['identificationNumber'] = (!empty($request->input('identificationNumber'))) ? $request->input('identificationNumber') : '0';
        $request['telephone'] = (!empty($request->input('telephone'))) ? $request->input('telephone') : 'N/A';
        $request['termsAndConditions'] = 2;

        $lead = $this->leadInterface->findLeadById($id);
        if ($lead->state != $request['state']) {
            $lead->state = $request['state'];
            $lead->leadStatus()->attach($request['state'], ['user_id' => auth()->user()->id]);
        }

        $leadRerpo = new leadRepository($lead);
        $leadRerpo->updateLead($request->input());
        if ($lead->leadQuotations->isNotEmpty()) {
            foreach ($lead->leadQuotations as $key => $value) {
                $request->merge(['id' => $value->id]);
                $this->assessorQuotationInterface->updateAssessorQuotations($request->except('state', '_method', '_token'));
            }
        }
        $request->session()->flash('message', 'Actualización Exitosa!');
        return redirect()->back();
    }

    public function dashboard(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $leadChannels  = $this->leadInterface->countLeadChannels($from, $to);
        $leadStatuses  = $this->leadInterface->countLeadStatuses($from, $to);
        $leadAssessors = $this->leadInterface->countLeadAssessors($from, $to);
        $leadProducts  = $this->leadInterface->countLeadProducts($from, $to);

        $leadProductDigitalChanels = $this->leadInterface->countLeadProductGenerals($from, $to, 1);
        $leadProductInsurances     = $this->leadInterface->countLeadProductGenerals($from, $to, 2);
        $leadProductWarranties     = $this->leadInterface->countLeadProductGenerals($from, $to, 3);
        $leadProductOportuyas      = $this->leadInterface->countLeadProductGenerals($from, $to, 6);
        $leadProductsCallCenter    = $this->leadInterface->countLeadProductGenerals($from, $to, 10);
        $leadProductsAdvancedUnit  = $this->leadInterface->countLeadProductGenerals($from, $to, 5);
        $leadProductWallets        = $this->leadInterface->countLeadProductGenerals($from, $to, 4);
        $leadProductJuridicales    = $this->leadInterface->countLeadProductGenerals($from, $to, 9);
        $leadProductLibranzas      = $this->leadInterface->countLeadProductGenerals($from, $to, 7);
        $leadProductEcommerces     = $this->leadInterface->countLeadProductGenerals($from, $to, 8);

        $leadServiceDigitalChanels = $this->leadInterface->countLeadServicesGenerals($from, $to, 1);
        $leadServiceInsurances     = $this->leadInterface->countLeadServicesGenerals($from, $to, 2);
        $leadServiceWarranties     = $this->leadInterface->countLeadServicesGenerals($from, $to, 3);
        $leadServiceOportuyas      = $this->leadInterface->countLeadServicesGenerals($from, $to, 6);
        $leadServicesCallCenter    = $this->leadInterface->countLeadServicesGenerals($from, $to, 10);
        $leadServicesAdvancedUnit  = $this->leadInterface->countLeadServicesGenerals($from, $to, 5);
        $leadServiceWallets        = $this->leadInterface->countLeadServicesGenerals($from, $to, 4);
        $leadServiceJuridicales    = $this->leadInterface->countLeadServicesGenerals($from, $to, 9);
        $leadServiceLibranzas      = $this->leadInterface->countLeadServicesGenerals($from, $to, 7);
        $leadServiceEcommerces     = $this->leadInterface->countLeadServicesGenerals($from, $to, 8);

        $leadStatusDigitalChanels = $this->leadInterface->countLeadStatusGenerals($from, $to, 1);
        $leadStatusInsurances     = $this->leadInterface->countLeadStatusGenerals($from, $to, 2);
        $leadStatusWarranties     = $this->leadInterface->countLeadStatusGenerals($from, $to, 3);
        $leadStatusOportuyas      = $this->leadInterface->countLeadStatusGenerals($from, $to, 6);
        $leadStatusCallCenter     = $this->leadInterface->countLeadStatusGenerals($from, $to, 10);
        $leadStatusAdvancedUnit   = $this->leadInterface->countLeadStatusGenerals($from, $to, 5);
        $leadStatusWallets        = $this->leadInterface->countLeadStatusGenerals($from, $to, 4);
        $leadStatusJuridicales    = $this->leadInterface->countLeadStatusGenerals($from, $to, 9);
        $leadStatusLibranzas      = $this->leadInterface->countLeadStatusGenerals($from, $to, 7);
        $leadStatusEcommerces     = $this->leadInterface->countLeadStatusGenerals($from, $to, 8);




        $leadServices       = $this->leadInterface->countLeadServices($from, $to);
        $leadPriceTotal     = $this->leadInterface->getLeadPriceTotal($from, $to);
        $leadPriceTotalSold = $this->LeadPriceInterface->getLeadPriceTotal($from, $to);
        $leadPrice          = $this->LeadPriceInterface->getPriceDigitalChanel($from, $to, 1);


        if (request()->has('from')) {
            $leadChannels              = $this->leadInterface->countLeadChannels(request()->input('from'), request()->input('to'));
            $leadStatuses              = $this->leadInterface->countLeadStatuses(request()->input('from'), request()->input('to'));
            $leadAssessors             = $this->leadInterface->countLeadAssessors(request()->input('from'), request()->input('to'));
            $leadProducts              = $this->leadInterface->countLeadProducts(request()->input('from'), request()->input('to'));
            $leadServices              = $this->leadInterface->countLeadServices(request()->input('from'), request()->input('to'));
            $leadPriceTotal            = $this->leadInterface->getLeadPriceTotal(request()->input('from'), request()->input('to'));
            $leadProductInsurances     = $this->leadInterface->countLeadProductGenerals(request()->input('from'), request()->input('to'), 2);
            $leadProductWarranties     = $this->leadInterface->countLeadProductGenerals(request()->input('from'), request()->input('to'), 3);
            $leadProductOportuyas      = $this->leadInterface->countLeadProductGenerals(request()->input('from'), request()->input('to'), 6);
            $leadProductsCallCenter    = $this->leadInterface->countLeadProductGenerals(request()->input('from'), request()->input('to'), 10);
            $leadProductsAdvancedUnit  = $this->leadInterface->countLeadProductGenerals(request()->input('from'), request()->input('to'), 5);
            $leadProductWallets        = $this->leadInterface->countLeadProductGenerals(request()->input('from'), request()->input('to'), 4);
            $leadProductJuridicales    = $this->leadInterface->countLeadProductGenerals(request()->input('from'), request()->input('to'), 9);
            $leadProductLibranzas      = $this->leadInterface->countLeadProductGenerals(request()->input('from'), request()->input('to'), 7);
            $leadProductEcommerces     = $this->leadInterface->countLeadProductGenerals(request()->input('from'), request()->input('to'), 8);
            $leadProductDigitalChanels = $this->leadInterface->countLeadProductGenerals(request()->input('from'), request()->input('to'), 1);
            $leadPriceTotalSold        = $this->LeadPriceInterface->getLeadPriceTotal(request()->input('from'), request()->input('to'));
            $leadPrice                 = $this->LeadPriceInterface->getPriceDigitalChanel(request()->input('from'), request()->input('to'), 1);

            $leadServiceInsurances     = $this->leadInterface->countLeadServicesGenerals(request()->input('from'), request()->input('to'), 2);
            $leadServiceWarranties     = $this->leadInterface->countLeadServicesGenerals(request()->input('from'), request()->input('to'), 3);
            $leadServiceOportuyas      = $this->leadInterface->countLeadServicesGenerals(request()->input('from'), request()->input('to'), 6);
            $leadServicesCallCenter    = $this->leadInterface->countLeadServicesGenerals(request()->input('from'), request()->input('to'), 10);
            $leadServicesAdvancedUnit  = $this->leadInterface->countLeadServicesGenerals(request()->input('from'), request()->input('to'), 5);
            $leadServiceWallets        = $this->leadInterface->countLeadServicesGenerals(request()->input('from'), request()->input('to'), 4);
            $leadServiceJuridicales    = $this->leadInterface->countLeadServicesGenerals(request()->input('from'), request()->input('to'), 9);
            $leadServiceLibranzas      = $this->leadInterface->countLeadServicesGenerals(request()->input('from'), request()->input('to'), 7);
            $leadServiceEcommerces     = $this->leadInterface->countLeadServicesGenerals(request()->input('from'), request()->input('to'), 8);
            $leadServiceDigitalChanels = $this->leadInterface->countLeadServicesGenerals(request()->input('from'), request()->input('to'), 1);

            $leadStatusDigitalChanels = $this->leadInterface->countLeadStatusGenerals(request()->input('from'), request()->input('to'), 1);
            $leadStatusInsurances     = $this->leadInterface->countLeadStatusGenerals(request()->input('from'), request()->input('to'), 2);
            $leadStatusWarranties     = $this->leadInterface->countLeadStatusGenerals(request()->input('from'), request()->input('to'), 3);
            $leadStatusOportuyas      = $this->leadInterface->countLeadStatusGenerals(request()->input('from'), request()->input('to'), 6);
            $leadStatusCallCenter     = $this->leadInterface->countLeadStatusGenerals(request()->input('from'), request()->input('to'), 10);
            $leadStatusAdvancedUnit   = $this->leadInterface->countLeadStatusGenerals(request()->input('from'), request()->input('to'), 5);
            $leadStatusWallets        = $this->leadInterface->countLeadStatusGenerals(request()->input('from'), request()->input('to'), 4);
            $leadStatusJuridicales    = $this->leadInterface->countLeadStatusGenerals(request()->input('from'), request()->input('to'), 9);
            $leadStatusLibranzas      = $this->leadInterface->countLeadStatusGenerals(request()->input('from'), request()->input('to'), 7);
            $leadStatusEcommerces     = $this->leadInterface->countLeadStatusGenerals(request()->input('from'), request()->input('to'), 8);
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
        $pricesTotal = $leadPriceTotalSold->sum('lead_price');

        $leadpriceTotals = $leadPrice->sum('lead_price');

        return view('digitalchannelleads.dashboardDigitalChanel', [
            'pricesTotal'               => $pricesTotal,
            'leadChannelNames'          => $leadChannelNames,
            'leadChannelValues'         => $leadChannelValues,
            'leadStatusesNames'         => $leadStatusesNames,
            'leadStatusesValues'        => $leadStatusesValues,
            'leadProductDigitalChanels' => $leadProductDigitalChanels,
            'leadProductInsurances'     => $leadProductInsurances,
            'leadProductWarranties'     => $leadProductWarranties,
            'leadProductOportuyas'      => $leadProductOportuyas,
            'leadProductsCallCenter'    => $leadProductsCallCenter,
            'leadProductsAdvancedUnit'  => $leadProductsAdvancedUnit,
            'leadProductWallets'        => $leadProductWallets,
            'leadProductJuridicales'    => $leadProductJuridicales,
            'leadProductLibranzas'      => $leadProductLibranzas,
            'leadProductEcommerces'     => $leadProductEcommerces,
            'leadAssessorsNames'        => $leadAssessorsNames,
            'leadAssessorsValues'       => $leadAssessorsValues,
            'leadProductsNames'         => $leadProductsNames,
            'leadProductsValues'        => $leadProductsValues,
            'leadServicesNames'         => $leadServicesNames,
            'leadServicesValues'        => $leadServicesValues,
            'leadServiceDigitalChanels' => $leadServiceDigitalChanels,
            'leadServiceInsurances'     => $leadServiceInsurances,
            'leadServiceWarranties'     => $leadServiceWarranties,
            'leadServiceOportuyas'      => $leadServiceOportuyas,
            'leadServicesCallCenter'    => $leadServicesCallCenter,
            'leadServicesAdvancedUnit'  => $leadServicesAdvancedUnit,
            'leadServiceWallets'        => $leadServiceWallets,
            'leadServiceJuridicales'    => $leadServiceJuridicales,
            'leadServiceLibranzas'      => $leadServiceLibranzas,
            'leadServiceEcommerces'     => $leadServiceEcommerces,
            'leadStatusDigitalChanels'  => $leadStatusDigitalChanels,
            'leadStatusInsurances'      => $leadStatusInsurances,
            'leadStatusWarranties'      => $leadStatusWarranties,
            'leadStatusOportuyas'       => $leadStatusOportuyas,
            'leadStatusCallCenter'      => $leadStatusCallCenter,
            'leadStatusAdvancedUnit'    => $leadStatusAdvancedUnit,
            'leadStatusWallets'         => $leadStatusWallets,
            'leadStatusJuridicales'     => $leadStatusJuridicales,
            'leadStatusLibranzas'       => $leadStatusLibranzas,
            'leadStatusEcommerces'      => $leadStatusEcommerces,
            'totalStatuses'             => $totalStatuses,
            'leadpriceTotal'            => $leadpriceTotals
        ]);
    }
    public function destroy($id)
    {
        $digitalChannelLead =  $this->leadInterface->findLeadDelete($id);
        $digitalChannelLead->delete();

        $userInfo = auth()->user();
        $data = [
            'modulo' => 'Panel Asesores',
            'proceso' => 'Leads',
            'accion' => 'Eliminar',
            'identificacion' => $id,
            'fecha' => date('Y-m-d H:i:s'),
            'usuario' => $userInfo->email,
            'state' => 'A'
        ];
        $oportudataLog = OportudataLog::create($data);

        return redirect()->back();
    }

    public function byProducts(int $id)
    {
        $data = LeadArea::with('leadProduct')->where('id', $id)->get();
        $array = [];
        foreach ($data as $area) {
            foreach ($area->leadProduct as $product) {
                $array[] = $product;
            }
        }
        return ($array);
    }

    public function byStatus(int $id)
    {

        $data = LeadArea::with('leadStatuses')->where('id', $id)->get();
        $array = [];
        foreach ($data as $area) {
            foreach ($area->leadStatuses as $statuses) {
                $array[] = $statuses;
            }
        }
        return ($array);
    }

    public function byService(int $id)
    {

        $data = LeadArea::with('Services')->where('id', $id)->get();
        $array = [];
        foreach ($data as $area) {
            foreach ($area->Services as $statuses) {
                $array[] = $statuses;
            }
        }
        return ($array);
    }

    public function byAssessors(int $id)
    {
        if (request()->has('subsidiary')) {
            return $this->assessorInterface->listAsessorssForSubsidiaries(request()->input('subsidiary'));
        }
        $data = $this->UserInterface->listUser($id);
        return json_decode($data);
    }

    public function getLead(int $telephone)
    {
        $data = $this->leadInterface->findLeadByTelephone($telephone);
        return $data;
    }

    public function byLeadNotifications($id)
    {
        $dates = [];
        $dataSuccess = [];
        $dataWarning = [];
        $dataDanger = [];
        $expirationDateSoat = [];

        $datas = $this->leadInterface->findLeadByAssessorFull($id);

        foreach ($datas as $key => $value) {

            if ($datas[$key]->expirationDateSoat != '' && Carbon::now() <= $datas[$key]->expirationDateSoat) {
                $expirationDateSoat[] = $datas[$key];
                if (Carbon::now()->diffInMinutes($datas[$key]->expirationDateSoat)) {
                    if (Carbon::now()->diffInDays($datas[$key]->expirationDateSoat) >= 1 && Carbon::now()->diffInDays($datas[$key]->expirationDateSoat) <= 90) {
                        $datas[$key]['diference'] =  Carbon::now()->diffInDays($datas[$key]->expirationDateSoat) . ' dias';
                    }
                    if (Carbon::now()->diffInDays($datas[$key]->expirationDateSoat) < 1 && Carbon::now()->diffInDays($datas[$key]->expirationDateSoat) >= 0) {
                        if (Carbon::now()->diffInHours($datas[$key]->expirationDateSoat) > 0) {
                            $datas[$key]['diference'] =  Carbon::now()->diffInHours($datas[$key]->expirationDateSoat) . ' horas';
                        } else {
                            $datas[$key]['diference'] =  Carbon::now()->diffInMinutes($datas[$key]->expirationDateSoat) . ' minutos';
                        }
                    }
                }
            }


            $dates[] = $datas[$key]->leadStatusesLogs->last();

            if ($dates[$key] != null) {
                if ($dates[$key]->created_at->diffInDays(Carbon::now()) <= 1) {
                    if ($dates[$key]->created_at->diffInDays(Carbon::now()) > 0) {
                        $dates[$key]['diference'] =  $dates[$key]->created_at->diffInDays(Carbon::now()) . ' dia';
                    } else {
                        if ($dates[$key]->created_at->diffInHours(Carbon::now()) > 0) {
                            $dates[$key]['diference'] =  $dates[$key]->created_at->diffInHours(Carbon::now()) . ' horas';
                        } else {
                            $dates[$key]['diference'] =  $dates[$key]->created_at->diffInMinutes(Carbon::now()) . ' minutos';
                        }
                    }
                    $dataSuccess[] =  $dates[$key];
                    $dates[$key]['nameLead'] = $datas[$key]->name;
                }
                if ($dates[$key]->created_at->diffInDays(Carbon::now()) > 1 && $dates[$key]->created_at->diffInDays(Carbon::now()) <= 2) {
                    $dates[$key]['diference'] =  $dates[$key]->created_at->diffInDays(Carbon::now()) . ' dias';
                    $dates[$key]['nameLead'] = $datas[$key]->name;
                    $dataWarning[] =  $dates[$key];
                }
                if ($dates[$key]->created_at->diffInDays(Carbon::now()) >= 3) {
                    $dates[$key]['diference'] =  $dates[$key]->created_at->diffInDays(Carbon::now()) . ' dias';
                    $dates[$key]['nameLead'] = $datas[$key]->name;
                    $dataDanger[] =  $dates[$key];
                }
            }
        }

        return ['success' => $dataSuccess, 'warning' => $dataWarning, 'danger' => $dataDanger, 'expirationDateSoat' => $expirationDateSoat];
    }
}
