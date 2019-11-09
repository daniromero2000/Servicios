<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        $queryCM = "SELECT lead.`id`, lead.`name`, lead.`lastName`, CONCAT(lead.`name`,' ',lead.`lastName`) as nameLast, lead.`email`, lead.`telephone`, lead.`identificationNumber`, lead.`created_at`, lead.`city`, lead.`typeService`, lead.`state`, lead.`channel`, lead.`nearbyCity`, lead.`campaign`, cam.`name` as campaignName
        FROM `leads` as lead
        LEFT JOIN `campaigns` as cam ON cam.id = lead.campaign
        WHERE (`channel` = 2 OR `channel` = 3)";

        if ($request->get('q') != '') {
            $queryCM .= sprintf(" AND (lead.`name` LIKE '%s' OR lead.`lastName` LIKE '%s' OR lead.`identificationNumber` LIKE '%s' OR lead.`telephone` LIKE '%s' )", '%' . $request->get('q') . '%', '%' . $request->get('q') . '%', '%' . $request->get('q') . '%', '%' . $request->get('q') . '%');
        }

        $queryCM .= "ORDER BY `created_at` DESC ";
        $queryCM .= sprintf(" LIMIT %s,30", $request['initFromCM']);

        return DB::select($queryCM);
    }

    public function store(Request $request)
    {
        $lead = new Lead;
        $lead->name = $request->get('name');
        $lead->lastName = $request->get('lastName');
        $lead->email = $request->get('email');
        $lead->telephone = $request->get('telephone');
        $lead->city = $request->get('city');
        $lead->typeService = $request->get('typeService');
        $lead->typeProduct = $request->get('typeProduct');
        $lead->channel = intval($request->get('channel'));
        $lead->termsAndConditions = $request->get('termsAndConditions');
        $lead->campaign = $request->get('campaign');
        $lead->save();

        return response()->json([true]);
    }
}
