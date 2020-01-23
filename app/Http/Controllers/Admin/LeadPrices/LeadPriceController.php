<?php

namespace App\Http\Controllers\Admin\LeadPrices;

use App\Entities\LeadPrices\LeadPrice;
use App\Entities\LeadPrices\Repositories\Interfaces\LeadPriceRepositoryInterface;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
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
        $lead->state = 7;
        $lead->save();


        $request->session()->flash('message', 'Cotización Exitosa!');
        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        $request['user_id'] = auth()->user()->id;
        $leadprice = $this->LeadPriceInterface->findLeadPriceById($id);
        $leadprice->update($request->input());

        if ($request->lead_price_status_id == 1) {
            $lead = $this->LeadInterface->findLeadById($request->lead_id);
            $lead->leadStatus()->attach(2, ['user_id' => $request['user_id']]);
            $lead->state = 2;
            $lead->save();
        }

        $request->session()->flash('message', 'Actalización Exitosa!');
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        // $Campaign = Campaigns::findOrfail($id);
        $digitalChannelLead =  $this->LeadPriceInterface->findLeadPriceById($id);
        $digitalChannelLead->delete();
        $request->session()->flash('message', 'Eliminado Exitosamente!');
        return redirect()->back();
    }
}