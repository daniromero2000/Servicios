<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Fqa;

class fqasController extends Controller
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
    public function index()
    {
        $fqas = DB::table('fqas')->latest()->get();
        return view('fqas.index', ['preguntas' => $fqas]);
    }

    /**
     * Display a listing of the resource for non-administrative personnel.
     *
     */

    public function indexPublic()
    {
        $fqas = DB::table('fqas')->select('id','question','answer')->latest()->get();
        return view('fqas.indexPublic', ['preguntas' => $fqas]);
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
        $fqas = new Fqa;
        $fqas->question = $request->get('question');
        $fqas->answer = $request->get('answer');
        $fqas->user_id = Auth::id();
        
        $fqas->save();
        return back();
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
        $fqa = Fqa::find($id);
        $fqa->question = $request->question;
        $fqa->answer = $request->answer;
        $fqa->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fqa=Fqa::findOrfail($id);
        $fqa->delete();
        return back();
    }
}
