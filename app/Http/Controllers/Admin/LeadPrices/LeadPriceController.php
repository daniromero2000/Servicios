<?php

namespace App\Http\Controllers\Admin\LeadPrices;

use App\Entities\LeadPrices\Repositories\Interfaces\LeadPriceRepositoryInterface;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Leads\Repositories\LeadRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadPriceController extends Controller
{
    private $LeadPriceInterface, $LeadInterface;

    public function __construct(
        LeadPriceRepositoryInterface $LeadPriceRepositoryInterface,
        LeadRepositoryInterface $leadRepositoryInterface
    ) {
        $this->LeadPriceInterface = $LeadPriceRepositoryInterface;
        $this->LeadInterface = $leadRepositoryInterface;
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $this->LeadPriceInterface->createLeadPrice($request->input());
        $lead = $this->LeadInterface->findLeadById($request->lead_id);
        $lead->leadStatus()->attach(7, ['user_id' => $request['user_id']]);
        $leadRerpo = new LeadRepository($lead);
        $lead->state = 7;
        $leadRerpo->updateLead($request->input());

        $request->session()->flash('message', 'Cotización Exitosa!');
        return redirect()->route('digitalchannelleads.show', $request->lead_id);
    }
}
