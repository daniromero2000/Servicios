<?php

namespace App\Http\Controllers\Admin\LeadWallets;

use App\Entities\Campaigns\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Entities\Channels\Repositories\Interfaces\ChannelRepositoryInterface;
use App\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use App\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Services\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Entities\LeadAreas\Repositories\LeadAreaRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use App\Entities\LeadPrices\Repositories\Interfaces\LeadPriceRepositoryInterface;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;

class LeadWalletController extends Controller
{
    private $LeadStatusesInterface, $leadInterface, $toolsInterface, $subsidiaryInterface;
    private $channelInterface, $serviceInterface, $campaignInterface, $customerInterface;
    private $leadProductInterface;

    public function __construct(
        LeadRepositoryInterface $LeadRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        ChannelRepositoryInterface $channelRepositoryInterface,
        ServiceRepositoryInterface $serviceRepositoryInterface,
        CampaignRepositoryInterface $campaignRepositoryInterface,
        LeadProductRepositoryInterface $leadProductRepositoryInterface,
        LeadStatusRepositoryInterface $leadStatusRepositoryInterface,
        LeadPriceRepositoryInterface $LeadPriceRepositoryInterface,
        UserRepositoryInterface $UserRepositoryInterface,
        LeadAreaRepository $LeadAreaRepositoryInterface,
        CityRepositoryInterface $CityRepositoryInterface

    ) {
        $this->leadInterface         = $LeadRepositoryInterface;
        $this->toolsInterface        = $toolRepositoryInterface;
        $this->channelInterface      = $channelRepositoryInterface;
        $this->serviceInterface      = $serviceRepositoryInterface;
        $this->campaignInterface     = $campaignRepositoryInterface;
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
        $area = 4;
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();

        $leadsOfMonth = $this->leadInterface->customListleadsTotal($from, $to, $area);
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $list = $this->leadInterface->customListleads($skip * 30, $area);
        if (request()->has('q')) {
            $list = $this->leadInterface->searchCustomLeads(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('state'),
                request()->input('assessor_id'),
                request()->input('city'),
                $area,
                request()->input('typeService'),
                request()->input('typeProduct')
            );
            $leadsOfMonth = $this->leadInterface->searchLeads(
                request()->input('q'),
                $skip,
                request()->input('from'),
                request()->input('to'),
                request()->input('state'),
                request()->input('assessor_id'),
                request()->input('city'),
                $area,
                request()->input('typeService'),
                request()->input('typeProduct')

            );
        }
        $listCount = $leadsOfMonth->count();


        $listAssessors = 1;
        return view('leadwallet.list', [
            'digitalChannelLeads' => $list,
            'optionsRoutes'       => (request()->segment(2)),
            'headers'             => ['', 'Estado', 'Lead', 'Asesor', 'Nombre', 'Celular', 'Ciudad', 'Area', 'Servicio', 'Producto', 'Fecha', 'Acciones'],
            'listCount'           => $listCount,
            'skip'                => $skip,
            'areas'               => $this->LeadAreaInterface->getLeadAreaDigitalChanel(),
            'cities'              => $this->cityInterface->getCityByLabel(),
            'channels'            => $this->channelInterface->getAllChannelNames(),
            'services'            => $this->serviceInterface->getAllServiceNames(),
            'campaigns'           => $this->campaignInterface->getAllCampaignNames(),
            'lead_products'       => $this->leadProductInterface->getAllLeadProductNames(),
            'lead_statuses'       => $this->LeadStatusesInterface->getAllLeadStatusesNames(),
            'listAssessors'       => $this->UserInterface->listUser($listAssessors)
        ]);
    }
}