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
        $this->middleware('auth')->except('indexPublic');// se exeptua ya que no 
    }
    /**
     * Display a listing of the resource and filter by question.
     /Proyecto: SERVISIOS FINANCIEROS
    **Caso de Uso: MODULO FAQS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador REST para la administracion de preguntas frecuentes.
    ** todos los metodos se dividen en dos partes consulta a BD y respuesta en json
    **Fecha: 12/12/2018
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Display a listing of the resource.
     *
     */

    public function index(Request $request)
    {
        //consulta
        $faqs = DB::table('faqs')
                ->select('question','answer','id')
                ->where('question','LIKE','%' . $request->q . '%')
                ->orderBy('id', 'desc')
                ->skip($request->page*($request->actual-1))
                ->take($request->page)
                ->get();
        //respuesta en json
        return response()->json($faqs);
    }

    /**
     * Display a listing of the resource for non-administrative personnel.
     *
     */

    public function indexPublic()
    {
        //consulta
        $faqs = DB::table('faqs')->select('id','question','answer')->latest()->get();
        //respuesta en json
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
        //consulta
        $faqs = new Faq;
        $faqs->question = $request->get('question');
        $faqs->answer = $request->get('answer');
        $faqs->user_id = Auth::id();
        
        $faqs->save();
        //respueta en json
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
        //consulta
        $faq = Faq::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        //respuesta en json
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
        //consulta
        $faq=Faq::findOrfail($id);
        $faq->delete();
        //respuesta en json
        return response()->json([true]);
    }

}
