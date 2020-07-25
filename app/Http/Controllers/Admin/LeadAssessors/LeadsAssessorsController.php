<?php

namespace App\Http\Controllers\Admin\LeadAssessors;

use App\Entities\Campaigns\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Entities\Channels\Repositories\Interfaces\ChannelRepositoryInterface;
use App\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\LeadAreas\Repositories\LeadAreaRepository;
use App\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Services\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Entities\LeadPrices\Repositories\Interfaces\LeadPriceRepositoryInterface;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;

class LeadsAssessorsController extends Controller
{
    private $LeadStatusesInterface, $leadInterface, $toolsInterface, $subsidiaryInterface;
    private $channelInterface, $serviceInterface, $campaignInterface, $customerInterface;
    private $leadProductInterface, $UserInterface, $LeadPriceInterface;

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
        CityRepositoryInterface $CityRepositoryInterface
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
        $this->LeadPriceInterface    = $LeadPriceRepositoryInterface;
        $this->UserInterface         = $UserRepositoryInterface;
        $this->LeadAreaInterface     = $LeadAreaRepositoryInterface;
        $this->cityInterface         = $CityRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $assessor = auth()->user()->id;
        $leadsOfMonth = $this->leadInterface->countLeadsAssessors($from, $to, $assessor);

        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->leadInterface->listLeadAssessors($skip * 30, $assessor);
        if (request()->has('q')) {
            $list = $this->leadInterface->searchLeads(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                12,
                $assessor,
                request()->input('channel'),
                request()->input('city'),
                request()->input('lead_area_id'),
                request()->input('typeService'),
                request()->input('typeProduct')
            );
            $leadsOfMonth = $this->leadInterface->searchLeads(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                12,
                $assessor,
                request()->input('channel'),
                request()->input('city'),
                request()->input('lead_area_id'),
                request()->input('typeService'),
                request()->input('typeProduct')

            );
        }

        $listCount = $list->count();
        $leadsOfMonth = $leadsOfMonth->count();
        $profile = 2;
        $subsidary   = $this->subsidiaryInterface->getSubsidiares();


        return view('leadAssessors.list', [
            'leadsOfMonth'        => $leadsOfMonth,
            'digitalChannelLeads' => $list,
            'optionsRoutes'       => (request()->segment(2)),
            'headers'             => ['', 'Estado', 'Lead', 'Asesor', 'Sucursal', 'Nombre', 'Celular', 'Ciudad', 'Canal', 'Area', 'Servicio', 'Producto', 'Fecha', 'Acciones'],
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
            'subsidaries'        => $subsidary
        ]);
    }

    public function listLeadsDirector(Request $request)
    {

        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
        $director = auth()->user()->Assessor->SUCURSAL;
        $leadsOfMonth = $this->leadInterface->countLeadsSubsidiary($from, $to, $director);

        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->leadInterface->listLeadSubsidiary($skip * 30, $director);
        if (request()->has('q')) {
            $list = $this->leadInterface->searchLeads(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                12,
                $director,
                request()->input('channel'),
                request()->input('city'),
                request()->input('lead_area_id'),
                request()->input('typeService'),
                request()->input('typeProduct')
            );
            $leadsOfMonth = $this->leadInterface->searchLeads(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                12,
                $director,
                request()->input('channel'),
                request()->input('city'),
                request()->input('lead_area_id'),
                request()->input('typeService'),
                request()->input('typeProduct')

            );
        }

        $listCount = $list->count();
        $leadsOfMonth = $leadsOfMonth->count();
        $profile = 2;
        $subsidary   = $this->subsidiaryInterface->getSubsidiares();


        return view('leadAssessors.list', [
            'leadsOfMonth'        => $leadsOfMonth,
            'digitalChannelLeads' => $list,
            'optionsRoutes'       => (request()->segment(2)),
            'headers'             => ['', 'Estado', 'Lead', 'Asesor', 'Sucursal', 'Nombre', 'Celular', 'Ciudad', 'Canal', 'Area', 'Servicio', 'Producto', 'Fecha', 'Acciones'],
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
}
