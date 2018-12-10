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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faqs = DB::table('faqs')
                ->select('question','answer','id')
                ->where('question','LIKE','%' . $request->q . '%')
                ->orderBy('id', 'desc')
                ->get();
        return response()->json($faqs);    
    }

    /**
     * Display a listing of the resource for non-administrative personnel.
     *
     */

    public function indexPublic()
    {
        $faqs = DB::table('faqs')->select('id','question','answer')->latest()->get();
        return view('faqs.indexPublic', ['preguntas' => $faqs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faqs = new Faq;
        $faqs->question = $request->get('question');
        $faqs->answer = $request->get('answer');
        $faqs->user_id = Auth::id();
        
        $faqs->save();
        return response()->json([true]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $faq = Faq::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return response()->json([true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq=Faq::findOrfail($id);
        $faq->delete();
        return response()->json([true]);
    }

}
