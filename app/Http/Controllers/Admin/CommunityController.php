<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Carbon\Carbon;


class CommunityController extends Controller
{
    private $leadInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface
    ) {
        $this->leadInterface = $leadRepositoryInterface;
    }

    public function index(Request $request)
    {
        $queryCM = "SELECT lead.`id`, lead.`name`, lead.`lastName`, CONCAT(lead.`name`,' ',lead.`lastName`) as nameLast, lead.`email`, lead.`telephone`, lead.`identificationNumber`, lead.`created_at`, lead.`city`, lead.`typeService`, lead.`state`, lead.`channel`, lead.`nearbyCity`, lead.`campaign`, cam.`name` as campaignName
        FROM `leads` as lead
        LEFT JOIN `campaigns` as cam ON cam.id = lead.campaign
        WHERE (`channel` = 2 OR `channel` = 3)";

        if ($request->get('q') != '') {

            $queryCM .= sprintf(
                " AND (lead.`name` LIKE '%s' OR lead.`lastName` LIKE '%s' OR lead.`identificationNumber` LIKE '%s' OR lead.`telephone` LIKE '%s')",
                '%' . $request->get('q') . '%',
                '%' . $request->get('q') . '%',
                '%' . $request->get('q') . '%',
                '%' . $request->get('q') . '%',
                '%' . $request->get('q') . '%'
            );
        }

        if ($request['city'] != '') {
            $queryCM .= sprintf(" AND (lead.`city` = '%s') ", $request['city']);
        }

        if ($request['typeService'] != '') {
            $queryCM .= sprintf(" AND (lead.`typeService` = '%s') ", $request['typeService']);
        }

        if ($request['state'] != '') {
            $queryCM .= sprintf(" AND (lead.`state` = '%s') ", $request['state']);
        }

        if ($request['fecha_ini'] != '') {
            $request['fecha_ini'] .= " 00:00:00";
            $queryCM .= sprintf(" AND (lead.`created_at` >= '%s') ", $request['fecha_ini']);
        }

        if ($request['fecha_fin'] != '') {
            $request['fecha_fin'] .= " 23:59:59";
            $queryCM .= sprintf(" AND (lead.`created_at` <= '%s') ", $request['fecha_fin']);
        }


        $respTotalLeads = DB::select($queryCM);

        $queryCM .= "ORDER BY `created_at` DESC ";
        $queryCM .= sprintf(" LIMIT %s,30", $request['initFromCM']);

        return [
            'leadsCommunity' => DB::select($queryCM),
            'totalLeads'   => count($respTotalLeads)
        ];
    }

    public function store(Request $request)
    {
        $this->leadInterface->createLead($request->input());

        return response()->json([true]);
    }


    public function dashboard(Request $request)
    {
        $to = Carbon::now();
        $from = Carbon::now()->subMonth();

        $leadChannels = $this->leadInterface->countLeadChannels($from, $to);


        if (request()->has('from')) {
            $leadChannels = $this->leadInterface->countLeadChannels(request()->input('from'), request()->input('to'));
        }

        $totalStatuses = $leadChannels->sum('total');

        foreach ($leadChannels as $key => $value) {
            $creditCards[$key]['percentage'] = ($value['total'] / $totalStatuses) * 100;
        }

        $leadChannels   = $leadChannels->toArray();
        $leadChannels   = array_values($leadChannels);

        $leadChannelNames  = [];
        $leadChannelValues  = [];

        foreach ($leadChannels as $leadChannel) {
            array_push($leadChannelNames, trim($leadChannel['channel']));
            array_push($leadChannelValues, trim($leadChannel['total']));
        }


        return view('Intentions.dashboard', [
            'leadChannelNames'  => $leadChannelNames,
            'leadChannelValues' => $leadChannelValues,
            'creditCards'  => $creditCards,
            'totalStatuses'  => $totalStatuses
        ]);
    }
}
