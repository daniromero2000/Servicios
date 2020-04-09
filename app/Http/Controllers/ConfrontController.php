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
        $dataQuestions = $request->input();
        $questions = $dataQuestions['questions'];
        $hits = 0;

        foreach ($questions as $key => $value) {
            if($value['name'] == 'formId'){
                $formId = $value['value'];
            }else{
                $answer = ['confront_form_id' => $formId, 'confront_form_question_id' => $value['name'], 'confront_form_option_id' => $value['value']];
                $this->confrontFormAnswerInterface->createConfrontFormAnswer($answer);
                $correctOption = $this->confrontFormOptionInterface->getQuestionCorrectOption($value['name']);
                if($correctOption[0]->id == $value['value']){
                    $hits ++;
                }
            }
        }
        return $hits;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($identificationNumber)
    {
        $confrontForm = [];

        $form = $this->confrontFormInterface->createConfrontForm(['identificationNumber' => $identificationNumber]);
        $questions = $this->confrontQuestionInterface->getConfrontQuestionPhoneChange();
        $questions = $questions->toArray();
        $totalQuestions = count($questions);
        $formQuestions = [];

        while (count($formQuestions) < 5) {
            $rand = rand(0,$totalQuestions-1);
            if(isset($questions[$rand])){
                $formQuestions[] = ['confront_question_id'=> $questions[$rand]['id']];
                unset($questions[$rand]);
            }
        }
        $formQuestions = $form->questions()->createMany($formQuestions);

        foreach ($formQuestions as $question) {
            $optionsForm = [];
            $questionOptions = [];
            $getOptions = $this->getOptionsQuestion($question->confront_question_id, $identificationNumber);
            $createOptions = $question->options()->createMany($getOptions);
            $options = $createOptions->toarray();

            foreach ($options as $option) {
                $questionOptions[] = ['optionId' => $option['id'], 'option' => $option['option']];
            }
            $confrontForm['questions'][] = [
                'question_id' => $question->id,
                'question' => $question->confrontQuestion->question,
                'options' => $questionOptions
            ];
        }

        $confrontForm['formId'] = $form->id;

        return $confrontForm;
    }

    private function getOptionsQuestion($questionId, $identificationNumber){
        $options = [];
        switch ($questionId) {
            case 1:
                $options = $this->confrontQuestionInterface->getDataQuestionOne($identificationNumber);
                break;

            case 2:
                $options = $this->confrontQuestionInterface->getDataQuestionTwo($identificationNumber);
                break;

            case 3:
                $options = $this->confrontQuestionInterface->getDataQuestionThree($identificationNumber);
                break;

            case 4:
                $options = $this->confrontQuestionInterface->getDataQuestionFour($identificationNumber);
                break;

            case 5:

                $options = $this->confrontQuestionInterface->getDataQuestionFive($identificationNumber);
                break;

            case 6:
                $options = $this->confrontQuestionInterface->getDataQuestionSix($identificationNumber);
                break;
        }

        return $options;
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
