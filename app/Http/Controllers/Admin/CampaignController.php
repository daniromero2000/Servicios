<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Campaigns;
use Illuminate\Support\Facades\DB;
use App\CampaignImages;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $query = "SELECT `campaign_images`.`name` AS imageName,`campaigns`.`id`, `campaigns`.`name`, `campaigns`.`description`, `campaigns`.`socialNetwork`, `campaigns`.`beginDate`, `campaigns`.`endingDate`, `campaigns`.`budget`, `campaigns`.`usedBudget`,`campaigns`.`remove`
            FROM campaigns  LEFT JOIN `campaign_images` ON `campaigns`.`id` = `campaign_images`.`campaign`
            WHERE 1 AND `remove`= 0";

        if ($request->get('q')) {
            $query .= sprintf(" AND (`name` LIKE '%s') ", '%' . $request->get('q') . '%');
        }

        if ($request->get('socialNetwork')) {
            $query .= sprintf(" AND `socialNetwork` = '%s' ", $request->get('socialNetwork'));
        }

        if ($request->get('budget')) {
            $query .= sprintf(" AND `budget` = '%s' ", $request->get('budget'));
        }

        if ($request->get('beginDate')) {
            $query .= sprintf(" AND `beginDate` = '%s' ", $request->get('beginDate'));
        }

        if ($request->get('endingDate')) {
            $query .= sprintf(" AND `endingDate` = '%s' ", $request->get('endingDate'));
        }

        $query .= " ORDER BY `id` DESC";
        $initFrom = ($request->get('limitFrom')) ? $request->get('limitFrom') : 0;
        $query .= sprintf(" LIMIT %s,30", $initFrom);

        return DB::select($query);
    }

    public function store(Request $request)
    {
        $campaign = new Campaigns;
        $campaign->name = $request->get('name') ? $request->get('name') : '';
        $campaign->socialNetwork = $request->get('socialNetwork') ? $request->get('socialNetwork') : '';
        $campaign->description = $request->get('description') ? $request->get('description') : '';
        $campaign->beginDate = $request->get('beginDate');
        $campaign->endingDate = $request->get('endingDate');
        $campaign->budget = $request->get('budget') ? intval($request->get('budget')) : 0;
        $campaign->usedBudget = $request->get('usedBudget') ? intval($request->get('usedBudget')) : 0;
        $campaign->save();

        return response()->json($campaign->id);
    }

    public function storeImage(Request $request)
    {
        for ($i = 0; $i < (int) $request->nImages; $i++) {
            $imageCampaign = new CampaignImages;
            $imageCampaign->name =  Explode("/", $request->file('imgs' . $i)->store('public'))[1]; //take only name
            $imageCampaign->campaign = $request->idCampaign;
            $imageCampaign->save();
        }
        return response()->json([true]);
    }

    public function show($id)
    {
        $campaign = Campaigns::selectRaw('campaign_images.name AS imageName,campaigns.id, campaigns.name, campaigns.description, campaigns.socialNetwork, campaigns.beginDate, campaigns.endingDate, campaigns.budget, campaigns.usedBudget,campaigns.remove')
            ->leftjoin('campaign_images', 'campaigns.id', '=', 'campaign_images.campaign')
            ->where('campaigns.id', '=', $id)
            ->orderBy('campaigns.id')->first();

        return response()->json($campaign);
    }

    public function update(Request $request)
    {
        $campaign = Campaigns::findOrfail($request->get('id'));
        $campaign->name = $request->get('name');
        $campaign->socialNetwork = $request->get('socialNetwork');
        $campaign->description = $request->get('description');
        $campaign->beginDate = $request->get('beginDate');
        $campaign->endingDate = $request->get('endingDate');
        $campaign->budget = intval($request->get('budget'));
        $campaign->usedBudget = intval($request->get('usedBudget'));
        $campaign->save();

        return response()->json([true]);
    }

    public function deleteCampaign(Request $request)
    {
        $campaign = Campaigns::findOrfail($request->get('id'));
        $campaign->remove = 1;
        $campaign->save();

        return response()->json($campaign);
    }

    public function destroy($id)
    {
        $Campaign = Campaigns::findOrfail($id);
        $Campaign->delete();

        return response()->json([true]);
    }
}
