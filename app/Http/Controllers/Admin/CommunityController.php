<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;

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

            if ($request->get('q') = 1) { } else { }

            $queryCM .= sprintf(
                " AND (lead.`name` LIKE '%s' OR lead.`lastName` LIKE '%s' OR lead.`identificationNumber` LIKE '%s' OR lead.`telephone` LIKE '%s')",
                '%' . $request->get('q') . '%',
                '%' . $request->get('q') . '%',
                '%' . $request->get('q') . '%',
                '%' . $request->get('q') . '%',
                '%' . $request->get('q') . '%'
            );
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
}
