<?php

namespace App\Entities\ConfrontQuestions\Repositories;

use App\Entities\CifinBasicDatas\Repositories\Interfaces\CifinBasicDataRepositoryInterface;
use App\Entities\CifinCtaExts\Repositories\Interfaces\CifinCtaExtRepositoryInterface;
use App\Entities\CifinCtaVigens\Repositories\Interfaces\CifinCtaVigenRepositoryInterface;
use App\Entities\CifinFinancialArrears\Repositories\Interfaces\CifinFinancialArrearRepositoryInterface;
use App\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Entities\ConfrontQuestions\ConfrontQuestion;
use App\Entities\ConfrontQuestions\Repositories\Interfaces\ConfrontQuestionRepositoryInterface;
use App\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Entities\ExtintFinancialCifins\Repositories\Interfaces\ExtintFinancialCifinRepositoryInterface;
use App\Entities\UpToDateFinancialCifins\Repositories\Interfaces\UpToDateFinancialCifinRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ConfrontQuestionRepository implements ConfrontQuestionRepositoryInterface
{
    private $cifinCtaExtInterface, $cifinCtaVigenInterface;
    private $upToDateFinancialCifinInterface, $extintFinancialCifinInterface, $cifinFinancialArrearInterface;
    private $cifinBasicDataInterface;
    private $cityInterface, $departmentInterface;

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
        CifinCtaExtRepositoryInterface $cifinCtaExtRepositoryInterface,
        UpToDateFinancialCifinRepositoryInterface $upToDateFinancialCifinRepositoryInterface,
        ExtintFinancialCifinRepositoryInterface $extintFinancialCifinRepositoryInterface,
        CifinFinancialArrearRepositoryInterface $cifinFinancialArrearRepositoryInterface,
        CifinBasicDataRepositoryInterface $cifinBasicDataRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        DepartmentRepositoryInterface $departmentRepositoryInterface
    ) {
        $this->model                           = $confrontQuestion;
        $this->cifinCtaVigenInterface          = $cifinCtaVigenRepositoryInterface;
        $this->cifinCtaExtInterface            = $cifinCtaExtRepositoryInterface;
        $this->upToDateFinancialCifinInterface = $upToDateFinancialCifinRepositoryInterface;
        $this->extintFinancialCifinInterface   = $extintFinancialCifinRepositoryInterface;
        $this->cifinFinancialArrearInterface   = $cifinFinancialArrearRepositoryInterface;
        $this->cifinBasicDataInterface         = $cifinBasicDataRepositoryInterface;
        $this->cityInterface                   = $cityRepositoryInterface;
        $this->departmentInterface             = $departmentRepositoryInterface;
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
        // 1.	CON CUAL DE LAS SIGUIENTES ENTIDADES TIENE O HA TENIDO CUENTA DE AHORROS

        $options = [];
        $customerCurrentEntities = [];
        $customerExtintEntities = [];
        $checkCurrentCostumerBankAccount = true;
        $checkExtintCustomerBankAccount = true;

        $currentCostumerBankAccount = $this->cifinCtaVigenInterface->getCustomerEntityName($identicationNumber);
        $currentCostumerBankAccount = $currentCostumerBankAccount->toArray();

        if(count($currentCostumerBankAccount) < 1){
            $currentCostumerBankAccount = [['vigentid' => 'Ninguna de las anteriores']];
            $checkCurrentCostumerBankAccount = false;
        }

        foreach ($currentCostumerBankAccount as $value) {
            $customerCurrentEntities[] = $value['vigentid'];
        }
        $currentBankAccounts = $this->cifinCtaVigenInterface->getNameEntities($customerCurrentEntities);
        $currentBankAccounts = $currentBankAccounts->toArray();

        foreach ($currentBankAccounts as $value) {
            $options[] = ['option' => $value['vigentid'], 'correct_option' => 0];
        }

        $correctOption = ['option' => $currentCostumerBankAccount[0]['vigentid'], 'correct_option' => 1];
        array_push($options, $correctOption);
        if($checkCurrentCostumerBankAccount){
            shuffle($options);
        }

        if($checkCurrentCostumerBankAccount == false){
            $options = [];
            $extintCustomerBankAccount = $this->cifinCtaExtInterface->getCustomerEntityName($identicationNumber);
            $extintCustomerBankAccount = $extintCustomerBankAccount->toArray();

            if(count($extintCustomerBankAccount) < 1){
                $extintCustomerBankAccount = [['cextentid'=>'Ninguna de las anteriores']];
                $checkExtintCustomerBankAccount = false;
            }

            foreach ($extintCustomerBankAccount as $value) {
                $customerExtintEntities[] = $value['cextentid'];
            }

            $extinctBankAccounts = $this->cifinCtaExtInterface->getNameEntities($customerExtintEntities);
            $extinctBankAccounts = $extinctBankAccounts->toArray();

            foreach ($extinctBankAccounts as $value) {
                $options[] = ['option' => $value['cextentid'], 'correct_option' => 0];
            }

            $correctOption = ['option' => $extintCustomerBankAccount[0]['cextentid'], 'correct_option' => 1];
            array_push($options, $correctOption);

            if($checkExtintCustomerBankAccount){
                shuffle($options);
            }
        }


        return $options;
    }

    public function getDataQuestionTwo($identificationNumber){
        // 2.	CON CUAL DE LAS SIGUIENTES ENTIDADES HA TENIDO TARJETA DE CREDITO

        $options = [];
        $customerFinancialEntities = [];
        $extintCustomerFinancialEntities = [];
        $checkFinancialCustomerCreditCard = true;
        $checkArrearFinancialCustomerCreditCard = true;
        $checkExtintnFinancialCustomerCreditCard = true;

        $financialCustomerCreditCard = $this->upToDateFinancialCifinInterface->getCustomerEntityName($identificationNumber);
        $financialCustomerCreditCard = $financialCustomerCreditCard->toArray();

        if(count($financialCustomerCreditCard) < 1){
            $financialCustomerCreditCard = [['fdnoment' => 'Ninguna de las anteriores']];
            $checkFinancialCustomerCreditCard = false;
        }

        foreach ($financialCustomerCreditCard as $value) {
            $customerFinancialEntities[] = $value['fdnoment'];
        }

        $financialCustomerCreditCardEntities = $this->upToDateFinancialCifinInterface->getNameEntities($customerFinancialEntities);
        $financialCustomerCreditCardEntities = $financialCustomerCreditCardEntities->toArray();

        foreach ($financialCustomerCreditCardEntities as $value) {
            $options[] = ['option' => $value['fdnoment'], 'correct_option' => 0];
        }

        $correctOption = ['option' => $financialCustomerCreditCard[0]['fdnoment'], 'correct_option' => 1];
        array_push($options, $correctOption);

        if(count($financialCustomerCreditCard) > 1){
            shuffle($options);
        }

        if($checkFinancialCustomerCreditCard == false){
            $options = [];
            $arrearFinancialCustomerCreditCard = $this->cifinFinancialArrearInterface->getCustomerEntityName($identificationNumber);
            $arrearFinancialCustomerCreditCard = $arrearFinancialCustomerCreditCard->toArray();

            if(count($arrearFinancialCustomerCreditCard) < 1){
                $arrearFinancialCustomerCreditCard = [['finnoment' => 'Ninguna de las anteriores']];
                $checkArrearFinancialCustomerCreditCard = false;
            }

            foreach ($arrearFinancialCustomerCreditCard as $value) {
                $extintCustomerFinancialEntities[] = $value['finnoment'];
            }

            $arrearFinancialCustomerCreditCardEntities = $this->cifinFinancialArrearInterface->getNameEntities($extintCustomerFinancialEntities);
            $arrearFinancialCustomerCreditCardEntities = $arrearFinancialCustomerCreditCardEntities->toArray();

            foreach ($arrearFinancialCustomerCreditCardEntities as $value) {
                $options[] = ['option' => $value['finnoment'], 'correct_option' => 0];
            }

            $correctOption = ['option' => $arrearFinancialCustomerCreditCard[0]['finnoment'], 'correct_option' => 1];
            array_push($options, $correctOption);

            if(count($arrearFinancialCustomerCreditCard) > 1){
                shuffle($options);
            }
        }

        if($checkArrearFinancialCustomerCreditCard == false && $checkFinancialCustomerCreditCard == false){
            $options = [];
            $extintnFinancialCustomerCreditCard = $this->extintFinancialCifinInterface->getCustomerEntityName($identificationNumber);
            $extintnFinancialCustomerCreditCard = $extintnFinancialCustomerCreditCard->toArray();

            if(count($extintnFinancialCustomerCreditCard) < 1){
                $extintnFinancialCustomerCreditCard = [['extnoment' => 'Ninguna de las anteriores']];
                $checkExtintnFinancialCustomerCreditCard = false;
            }

            foreach ($extintnFinancialCustomerCreditCard as $value) {
                $extintCustomerFinancialEntities[] = $value['extnoment'];
            }

            $extintnFinancialCustomerCreditCardEntities = $this->extintFinancialCifinInterface->getNameEntities($extintCustomerFinancialEntities);
            $extintnFinancialCustomerCreditCardEntities = $extintnFinancialCustomerCreditCardEntities->toArray();

            foreach ($extintnFinancialCustomerCreditCardEntities as $value) {
                $options[] = ['option' => $value['extnoment'], 'correct_option' => 0];
            }

            $correctOption = ['option' => $extintnFinancialCustomerCreditCard[0]['extnoment'], 'correct_option' => 1];
            array_push($options, $correctOption);

            if($checkExtintnFinancialCustomerCreditCard){
                shuffle($options);
            }
        }

        return $options;
    }

    public function getDataQuestionThree($identificationNumber){
        // 3.	CUAL ES EL DEPARTAMENTO DE EXPEDICION DE SU DOCUMENTO DE IDENTIDAD

        $options = [];
        $checkDepartmentExpedition = true;

        $cityExpedition = $this->cifinBasicDataInterface->getCityExpedition($identificationNumber);
        $cityExpedition = $cityExpedition->toArray();
        if(count($cityExpedition) < 1){
            $departmentExpedition = ['DEPARTAMENTO' => 'Ninguna de las anteriores', 'correct_option' => 1];
            $checkDepartmentExpedition = false;
        }else{
            $departmentExpedition = $this->cityInterface->getCityByName($cityExpedition[0]['terlugexp']);
            $departmentExpedition = $departmentExpedition->toArray();
        }


        $departments = $this->departmentInterface->getConfrontDepartments($departmentExpedition['DEPARTAMENTO']);

        foreach ($departments as $value) {
            $options[] = ['option' => $value['NAME'], 'correct_option' => 0];
        }

        array_push($options, ['option' => $departmentExpedition['DEPARTAMENTO'], 'correct_option' => 1]);

        if($checkDepartmentExpedition){
            shuffle($options);
        }

        return $options;
    }

    public function getDataQuestionFour($identicationNumber){
        //  4.	CON CUAL DE LOS SIGUIENTES BANCOS PRESENTA UN CREDITO DE VIVIENDA._md-datepicker-floating-label

        
    }
}
