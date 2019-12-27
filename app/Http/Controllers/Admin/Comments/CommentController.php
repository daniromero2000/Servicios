<?php

namespace App\Http\Controllers\Admin\Comments;

use App\Entities\Comments\Repositories\Interfaces\CommentRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentInterface;

    public function __construct(
        CommentRepositoryInterface $commentRepositoryInterface
    ) {
        $this->commentInterface = $commentRepositoryInterface;
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        unset($request['state']);
        $request['idLogin'] = auth()->user()->id;
        return $this->commentInterface->createComment($request->input());

        return response()->json([true]);
    }
}
