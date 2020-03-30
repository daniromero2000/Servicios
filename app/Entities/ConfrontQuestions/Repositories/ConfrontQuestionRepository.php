<?php

namespace App\Entities\ConfrontQuestions\Repositories;

use App\Entities\CifinCtaExts\Repositories\Interfaces\CifinCtaExtRepositoryInterface;
use App\Entities\CifinCtaVigens\Repositories\Interfaces\CifinCtaVigenRepositoryInterface;
use App\Entities\ConfrontQuestions\ConfrontQuestion;
use App\Entities\ConfrontQuestions\Repositories\Interfaces\ConfrontQuestionRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ConfrontQuestionRepository implements ConfrontQuestionRepositoryInterface
{
    private $cifinCtaExtInterface, $cifinCtaVigenInterface;

    private $columns = [
        'id',
        'question',
        'type',
        'created_at',
        'updated_at',
    ];

    public function __construct(
        ConfrontQuestion $confrontQuestion,
        CifinCtaVigenRepositoryInterface $cifinCtaVigenRepositoryInterface,
        CifinCtaExtRepositoryInterface $cifinCtaExtRepositoryInterface
    ) {
        $this->model                  = $confrontQuestion;
        $this->cifinCtaVigenInterface = $cifinCtaVigenRepositoryInterface;
        $this->cifinCtaExtInterface   = $cifinCtaExtRepositoryInterface;
    }

    public function createConfrontQuestion($data){
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            //throw $th;
        }
    }

    public function getAllConfrontQuestions()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getConfrontQuestionPhoneChange(){
        try {
            return $this->model->where('type',1)->orWhere('type',3)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getConfrontQuestionCreditRequest(){
        try {
            return $this->model->where('type',1)->orWhere('type',3)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getDataQuestionOne($identicationNumber){
        $options = [];

        $currentCostumerBankAccount = $this->cifinCtaVigenInterface->getCustomerEntityName($identicationNumber);
        $currentCostumerBankAccount = $currentCostumerBankAccount->toArray();

        if(count($currentCostumerBankAccount) < 1){
            $currentCostumerBankAccount = [['vigentid' => 'Ninguna de las anteriores']];
        }
        $currentBankAccounts = $this->cifinCtaVigenInterface->getNameEntities($currentCostumerBankAccount[0]['vigentid']);
        $currentBankAccounts = $currentBankAccounts->toArray();
        foreach ($currentBankAccounts as $value) {
            $options[] = ['option' => $value['vigentid'], 'correct_option' => 0];
        }
        
        $correctOption = ['option' => $currentCostumerBankAccount[0]['vigentid'], 'correct_option' => 1];
        array_push($options, $correctOption);
        shuffle($options);

        if(count($currentCostumerBankAccount) < 1){
            $extinctCustomerBankAccount = $this->cifinCtaExtInterface->getCustomerEntityName($identicationNumber);
            $extinctCustomerBankAccount = $extinctCustomerBankAccount->toArray();
            if(count($extinctCustomerBankAccount) < 1){
                $extinctCustomerBankAccount = [['cextentid'=>'Ninguna de las anteriores']];
            }
            $extinctBankAccounts = $this->cifinCtaExtInterface->getNameEntities($extinctCustomerBankAccount[0]['cextentid']);
            $extinctBankAccounts = $extinctBankAccounts->toArray();
            foreach ($currentBankAccounts as $value) {
                $options[] = ['option' => $value['cextentid'], 'correct_option' => 0];
            }
            $correctOption = ['option' => $currentCostumerBankAccount[0]['cextentid'], 'correct_option' => 1];
            array_push($options, $correctOption);
            shuffle($options);
        }


        return $options;
    }
}
