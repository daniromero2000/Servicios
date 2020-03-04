<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Faq;

class faqsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('indexPublic');
    }

    public function index(Request $request)
    {
        $faqs = DB::table('faqs')
            ->select('question', 'answer', 'id')
            ->where('question', 'LIKE', '%' . $request->q . '%')
            ->orderBy('id', 'desc')
            ->skip($request->page * ($request->actual - 1))
            ->take($request->page)
            ->get();

        return response()->json($faqs);
    }


    public function indexPublic()
    {
        return view('faqs.indexPublic', [
            'preguntas' => DB::table('faqs')->select('id', 'question', 'answer')->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $faqs = new Faq;
        $faqs->question = $request->get('question');
        $faqs->answer = $request->get('answer');
        $faqs->user_id = Auth::id();

        $faqs->save();
        return response()->json([true]);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return response()->json([true]);
    }

    public function destroy($id)
    {
        $faq = Faq::findOrfail($id);
        $faq->delete();

        return response()->json([true]);
    }

    public function test(Request $request){
        return $request;
    }
}
