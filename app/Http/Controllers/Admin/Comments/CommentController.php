<?php

namespace App\Http\Controllers\Admin\Comments;

use App\Entities\Comments\Repositories\Interfaces\CommentRepositoryInterface;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    private $commentInterface,  $leadInterface;

    public function __construct(
        CommentRepositoryInterface $commentRepositoryInterface,
        LeadRepositoryInterface $leadRepositoryInterface
    ) {
        $this->commentInterface = $commentRepositoryInterface;
        $this->leadInterface = $leadRepositoryInterface;
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        unset($request['state']);
        $request['idLogin'] = auth()->user()->id;
        $this->commentInterface->createComment($request->except(['_token']));
        $lead = $this->leadInterface->findLeadById($request->idLead);
        $lead->leadStatus()->attach(4, ['user_id' => $request['idLogin']]);
        $lead->state = 4;
        $lead->save();

        return redirect()->back();
    }
}