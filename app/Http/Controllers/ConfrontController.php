<?php

namespace App\Http\Controllers;

use App\Entities\ConfrontFormAnswers\Repositories\Interfaces\ConfrontFormAnswerRepositoryInterface;
use App\Entities\ConfrontFormOptions\Repositories\Interfaces\ConfrontFormOptionRepositoryInterface;
use App\Entities\ConfrontFormQuestions\Repositories\Interfaces\ConfrontFormQuestionRepositoryInterface;
use App\Entities\ConfrontForms\Repositories\Interfaces\ConfrontFormRepositoryInterface;
use App\Entities\ConfrontQuestions\Repositories\Interfaces\ConfrontQuestionRepositoryInterface;
use App\Entities\ConfrontResults\Repositories\Interfaces\ConfrontResultRepositoryInterface;
use Illuminate\Http\Request;

class ConfrontController extends Controller
{
    private $confrontFormAnswerInterface, $confrontFormOptionInterface, $confrontFormQuestionInterface;
    private $confrontFormInterface, $confrontQuestionInterface, $confrontResultInterface;

    public function __construct(
        ConfrontFormAnswerRepositoryInterface $confrontFormAnswerRepositoryInterface,
        ConfrontFormOptionRepositoryInterface $confrontFormOptionRepositoryInterface,
        ConfrontFormQuestionRepositoryInterface $confrontFormQuestionRepositoryInterface,
        ConfrontFormRepositoryInterface $confrontFormRepositoryInterface,
        ConfrontQuestionRepositoryInterface $confrontQuestionRepositoryInterface,
        ConfrontResultRepositoryInterface $confrontResultRepositoryInterface
    ){
        $this->confrontFormAnswerInterface   = $confrontFormAnswerRepositoryInterface;
        $this->confrontFormOptionInterface   = $confrontFormOptionRepositoryInterface;
        $this->confrontFormQuestionInterface = $confrontFormQuestionRepositoryInterface;
        $this->confrontFormInterface         = $confrontFormRepositoryInterface;
        $this->confrontQuestionInterface     = $confrontQuestionRepositoryInterface;
        $this->confrontResultInterface       = $confrontResultRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($identificationNumber)
    {
        dd($this->confrontQuestionInterface->getDataQuestionSix($identificationNumber));
        $form = $this->confrontFormInterface->createConfrontForm(['identificationNumber' => $identificationNumber]);
        $questions = $this->confrontQuestionInterface->getConfrontQuestionPhoneChange();
        $questions = $questions->toArray();
        $totalQuestions = count($questions);
        $formQuestions = [];

        while (count($formQuestions) < 5) {
            $rand = rand(0,$totalQuestions-1);
            if(isset($questions[$rand])){
                $formQuestions[] = $questions[$rand];
                $this->confrontFormQuestionInterface->createConfrontFormQuestion(['confront_question_id' => $questions[$rand]['id'], 'confront_form_id' => $form->id]);
                unset($questions[$rand]);
            }
        }
        dd($formQuestions);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
