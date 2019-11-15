<?php

namespace App\Http\Controllers\Admin\Comments;

use App\Entities\Comments\Repositories\Interfaces\CommentRepositoryInterface;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    private $commentInterface;

    public function __construct(
        CommentRepositoryInterface $commentRepositoryInterface
    ) {
        $this->commentInterface = $commentRepositoryInterface;
        $this->middleware('auth');
    }

    public function addLeadComent($lead, $comment)
    {
        $request['idLogin'] = auth()->user()->id;
        $request['idLead']  = $lead;
        $request['comment'] = $comment;
        $this->commentInterface->createComment($request);

        return response()->json([true]);
    }
}
