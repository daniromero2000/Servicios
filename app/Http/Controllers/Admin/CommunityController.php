<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\Users\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;


class CommunityController extends Controller
{
    private $leadInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->leadInterface = $leadRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->userInterface = $userRepositoryInterface;
    }

    public function dashboard()
    {
        $to = Carbon::now();
        $from = Carbon::now()->subMonth();

        $leadChannels = $this->leadInterface->countLeadChannels($from, $to);
        $leadStatuses = $this->leadInterface->countLeadStatuses($from, $to);

        if (request()->has('from')) {
            $leadChannels = $this->leadInterface->countLeadChannels(request()->input('from'), request()->input('to'));
            $leadStatuses = $this->leadInterface->countLeadStatuses(request()->input('from'), request()->input('to'));
        }

        foreach ($leadChannels as $key => $status) {
            $leadChannels[] = ['channel' => $key, 'total' => count($leadChannels[$key])];
            unset($leadChannels[$key]);
        }

        foreach ($leadStatuses as $key => $status) {
            $leadStatuses[] = ['status' => $key, 'total' => count($leadStatuses[$key])];
            unset($leadStatuses[$key]);
        }

        $totalStatuses = $leadChannels->sum('total');

        foreach ($leadChannels as $key => $value) {
            $creditCards[$key]['percentage'] = ($value['total'] / $totalStatuses) * 100;
        }

        $leadChannels   = $leadChannels->toArray();
        $leadChannels   = array_values($leadChannels);

        $leadStatuses   = $leadStatuses->toArray();
        $leadStatuses   = array_values($leadStatuses);

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

        return view('communityLeads.dashboard', [
            'leadChannelNames'  => $leadChannelNames,
            'leadChannelValues' => $leadChannelValues,
            'leadStatusesNames'  => $leadStatusesNames,
            'leadStatusesValues' => $leadStatusesValues,
            'creditCards'  => $creditCards,
            'totalStatuses'  => $totalStatuses
        ]);
    }
}
