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
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\UbicaAddresses\Repositories\Interfaces\UbicaAddressRepositoryInterface;
use App\Entities\UbicaCellPhones\Repositories\Interfaces\UbicaCellPhoneRepositoryInterface;
use App\Entities\Ubicas\Repositories\Interfaces\UbicaRepositoryInterface;
use App\Entities\UpToDateFinancialCifins\Repositories\Interfaces\UpToDateFinancialCifinRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ConfrontQuestionRepository implements ConfrontQuestionRepositoryInterface
{
    private $cifinCtaExtInterface, $cifinCtaVigenInterface;
    private $upToDateFinancialCifinInterface, $extintFinancialCifinInterface, $cifinFinancialArrearInterface;
    private $cifinBasicDataInterface;
    private $cityInterface, $departmentInterface;
    private $ubicaInterface, $ubicaAddressInterface, $ubicaCellPhoneInterface;
    private $toolInterface;

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
        DepartmentRepositoryInterface $departmentRepositoryInterface,
        UbicaRepositoryInterface $ubicaRepositoryInterface,
        UbicaAddressRepositoryInterface $ubicaAddressRepositoryInterface,
        UbicaCellPhoneRepositoryInterface $ubicaCellPhoneRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
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
        $this->ubicaInterface                  = $ubicaRepositoryInterface;
        $this->ubicaAddressInterface           = $ubicaAddressRepositoryInterface;
        $this->ubicaCellPhoneInterface         = $ubicaCellPhoneRepositoryInterface;
        $this->toolInterface                   = $toolRepositoryInterface;
    }

    public function createConfrontQuestion($data)
    {
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

    public function getConfrontQuestionPhoneChange()
    {
        try {
            return $this->model->where('type', 1)->orWhere('type', 3)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getConfrontQuestionCreditRequest()
    {
        try {
            return $this->model->where('type', 1)->orWhere('type', 3)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getDataQuestionOne($identificationNumber)
    {
        // 1.	CON CUAL DE LAS SIGUIENTES ENTIDADES TIENE O HA TENIDO CUENTA DE AHORROS
        $options = [];
        $customerEntities = [];
        $checkCurrentCostumerBankAccount = true;
        $checkExtintCustomerBankAccount = true;

        $currentCostumerBankAccount = $this->cifinCtaVigenInterface->getCustomerEntityName($identificationNumber);
        $currentCostumerBankAccount = $currentCostumerBankAccount->toArray();

        if (count($currentCostumerBankAccount) < 1) {
            $currentCostumerBankAccount = [['vigentid' => 'NINGUNA DE LAS ANTERIORES']];
            $checkCurrentCostumerBankAccount = false;
        }

        foreach ($currentCostumerBankAccount as $value) {
            array_push($customerEntities, $value['vigentid']);
        }

        $extintCustomerBankAccount = $this->cifinCtaExtInterface->getCustomerEntityName($identificationNumber);
        $extintCustomerBankAccount = $extintCustomerBankAccount->toArray();

        if (count($extintCustomerBankAccount) < 1) {
            $extintCustomerBankAccount = [['cextentid' => 'NINGUNA DE LAS ANTERIORES']];
            $checkExtintCustomerBankAccount = false;
        }

        foreach ($extintCustomerBankAccount as $value) {
            array_push($customerEntities, $value['cextentid']);
        }


        $currentBankAccounts = $this->cifinCtaVigenInterface->getNameEntities($customerEntities);
        $currentBankAccounts = $currentBankAccounts->toArray();

        foreach ($currentBankAccounts as $value) {
            $options[] = ['option' => $this->toolInterface->upperCase($value['vigentid']), 'correct_option' => 0];
        }

        $correctOption = ['option' => $this->toolInterface->upperCase($currentCostumerBankAccount[0]['vigentid']), 'correct_option' => 1];
        array_push($options, $correctOption);

        if ($checkCurrentCostumerBankAccount) {
            shuffle($options);
        }

        if ($checkCurrentCostumerBankAccount == false) {
            $options = [];

            $extinctBankAccounts = $this->cifinCtaExtInterface->getNameEntities($customerEntities);
            $extinctBankAccounts = $extinctBankAccounts->toArray();

            foreach ($extinctBankAccounts as $value) {
                $options[] = ['option' => $this->toolInterface->upperCase($value['cextentid']), 'correct_option' => 0];
            }

            $correctOption = ['option' => $this->toolInterface->upperCase($extintCustomerBankAccount[0]['cextentid']), 'correct_option' => 1];
            array_push($options, $correctOption);

            if ($checkExtintCustomerBankAccount) {
                shuffle($options);
            }
        }


        return $options;
    }

    public function getDataQuestionTwo($identificationNumber)
    {
        // 2.	CON CUAL DE LAS SIGUIENTES ENTIDADES HA TENIDO TARJETA DE CREDITO

        $options = [];
        $customerEntities = [];
        $checkFinancialCustomerCreditCard = true;
        $checkArrearFinancialCustomerCreditCard = true;
        $checkExtintnFinancialCustomerCreditCard = true;

        $financialCustomerCreditCard = $this->upToDateFinancialCifinInterface->getCustomerEntityName($identificationNumber);
        $financialCustomerCreditCard = $financialCustomerCreditCard->toArray();

        if (count($financialCustomerCreditCard) < 1) {
            $financialCustomerCreditCard = [['fdnoment' => 'NINGUNA DE LAS ANTERIORES']];
            $checkFinancialCustomerCreditCard = false;
        }

        foreach ($financialCustomerCreditCard as $value) {
            array_push($customerEntities, $value['fdnoment']);
        }

        $arrearFinancialCustomerCreditCard = $this->cifinFinancialArrearInterface->getCustomerEntityName($identificationNumber);
        $arrearFinancialCustomerCreditCard = $arrearFinancialCustomerCreditCard->toArray();

        if (count($arrearFinancialCustomerCreditCard) < 1) {
            $arrearFinancialCustomerCreditCard = [['finnoment' => 'NINGUNA DE LAS ANTERIORES']];
            $checkArrearFinancialCustomerCreditCard = false;
        }

        foreach ($arrearFinancialCustomerCreditCard as $value) {
            array_push($customerEntities, $value['finnoment']);
        }

        $extintnFinancialCustomerCreditCard = $this->extintFinancialCifinInterface->getCustomerEntityName($identificationNumber);
        $extintnFinancialCustomerCreditCard = $extintnFinancialCustomerCreditCard->toArray();

        if (count($extintnFinancialCustomerCreditCard) < 1) {
            $extintnFinancialCustomerCreditCard = [['extnoment' => 'NINGUNA DE LAS ANTERIORES']];
            $checkExtintnFinancialCustomerCreditCard = false;
        }

        foreach ($extintnFinancialCustomerCreditCard as $value) {
            array_push($customerEntities, $value['extnoment']);
        }

        $financialCustomerCreditCardEntities = $this->upToDateFinancialCifinInterface->getNameEntities($customerEntities);
        $financialCustomerCreditCardEntities = $financialCustomerCreditCardEntities->toArray();

        foreach ($financialCustomerCreditCardEntities as $value) {
            $options[] = ['option' => $this->toolInterface->upperCase($value['fdnoment']), 'correct_option' => 0];
        }

        $correctOption = ['option' => $this->toolInterface->upperCase($financialCustomerCreditCard[0]['fdnoment']), 'correct_option' => 1];
        array_push($options, $correctOption);

        if ($checkFinancialCustomerCreditCard) {
            shuffle($options);
        }

        if ($checkFinancialCustomerCreditCard == false) {
            $options = [];

            $arrearFinancialCustomerCreditCardEntities = $this->cifinFinancialArrearInterface->getNameEntities($customerEntities);
            $arrearFinancialCustomerCreditCardEntities = $arrearFinancialCustomerCreditCardEntities->toArray();

            foreach ($arrearFinancialCustomerCreditCardEntities as $value) {
                $options[] = ['option' => $this->toolInterface->upperCase($value['finnoment']), 'correct_option' => 0];
            }

            $correctOption = ['option' => $this->toolInterface->upperCase($arrearFinancialCustomerCreditCard[0]['finnoment']), 'correct_option' => 1];
            array_push($options, $correctOption);

            if ($checkArrearFinancialCustomerCreditCard) {
                shuffle($options);
            }
        }

        if ($checkArrearFinancialCustomerCreditCard == false && $checkFinancialCustomerCreditCard == false) {
            $options = [];

            $extintnFinancialCustomerCreditCardEntities = $this->extintFinancialCifinInterface->getNameEntities($customerEntities);
            $extintnFinancialCustomerCreditCardEntities = $extintnFinancialCustomerCreditCardEntities->toArray();

            foreach ($extintnFinancialCustomerCreditCardEntities as $value) {
                $options[] = ['option' => $this->toolInterface->upperCase($value['extnoment']), 'correct_option' => 0];
            }

            $correctOption = ['option' => $this->toolInterface->upperCase($extintnFinancialCustomerCreditCard[0]['extnoment']), 'correct_option' => 1];
            array_push($options, $correctOption);

            if ($checkExtintnFinancialCustomerCreditCard) {
                shuffle($options);
            }
        }

        return $options;
    }

    public function getDataQuestionThree($identificationNumber)
    {
        // 3.	CUAL ES EL DEPARTAMENTO DE EXPEDICION DE SU DOCUMENTO DE IDENTIDAD
        try {
            $options = [];
            $checkDepartmentExpedition = true;

            $cityExpedition = $this->cifinBasicDataInterface->getCityExpedition($identificationNumber);
            $cityExpedition = $cityExpedition->toArray();
            if (count($cityExpedition) < 1) {
                $departmentExpedition = ['DEPARTAMENTO' => 'NINGUNA DE LAS ANTERIORES', 'correct_option' => 1];
                $checkDepartmentExpedition = false;
            } else {
                $departmentExpedition = $this->cityInterface->getCityByName($cityExpedition[0]['terlugexp']);
                $departmentExpedition = $departmentExpedition->toArray();
            }


            $departments = $this->departmentInterface->getConfrontDepartments($departmentExpedition['DEPARTAMENTO']);

            foreach ($departments as $value) {
                $options[] = ['option' => $this->toolInterface->upperCase($value['NAME']), 'correct_option' => 0];
            }

            array_push($options, ['option' => $this->toolInterface->upperCase($departmentExpedition['DEPARTAMENTO']), 'correct_option' => 1]);

            if ($checkDepartmentExpedition) {
                shuffle($options);
            }

            return $options;
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getDataQuestionFour($identificationNumber)
    {
        //  4.	CON CUAL DE LOS SIGUIENTES BANCOS PRESENTA UN CREDITO DE VIVIENDA.
        $options                                   = [];
        $customerHousingCreditEntities             = [];
        $checkCustomerFinancialHousingCredit       = true;
        $checkCustomerExtintFinancialHousingCredit = true;
        $checkCustomerArrearFinancialHousingCredit = true;

        $customerFinancialHousingCredit = $this->upToDateFinancialCifinInterface->getCustomerEntityNameHousingCredit($identificationNumber);
        $customerFinancialHousingCredit = $customerFinancialHousingCredit->toArray();

        if (count($customerFinancialHousingCredit) < 1) {
            $customerFinancialHousingCredit = [['fdnoment' => 'NINGUNA DE LAS ANTERIORES']];
            $checkCustomerFinancialHousingCredit = false;
        }

        foreach ($customerFinancialHousingCredit as $value) {
            array_push($customerHousingCreditEntities, $value['fdnoment']);
        }

        $customerArrearFinancialHousingCredit = $this->cifinFinancialArrearInterface->getCustomerEntityNameHousingCredit($identificationNumber);
        $customerArrearFinancialHousingCredit = $customerArrearFinancialHousingCredit->toArray();

        if (count($customerArrearFinancialHousingCredit) < 1) {
            $customerArrearFinancialHousingCredit = [['finnoment' => 'NINGUNA DE LAS ANTERIORES']];
            $checkCustomerArrearFinancialHousingCredit = false;
        }

        foreach ($customerArrearFinancialHousingCredit as $value) {
            array_push($customerHousingCreditEntities, $value['finnoment']);
        }

        $customerExtintFinancialHousingCredit = $this->extintFinancialCifinInterface->getCustomerEntityNameHousingCredit($identificationNumber);
        $customerExtintFinancialHousingCredit = $customerExtintFinancialHousingCredit->toArray();

        if (count($customerExtintFinancialHousingCredit) < 1) {
            $customerExtintFinancialHousingCredit = [['extnoment' => 'NINGUNA DE LAS ANTERIORES']];
            $checkCustomerExtintFinancialHousingCredit = false;
        }

        foreach ($customerExtintFinancialHousingCredit as $value) {
            array_push($customerHousingCreditEntities, $value['extnoment']);
        }

        $financialHousingCredit = $this->upToDateFinancialCifinInterface->getNameEntitiesHousingCredit($customerHousingCreditEntities);
        $financialHousingCredit = $financialHousingCredit->toArray();

        foreach ($financialHousingCredit as $value) {
            $options[] = ['option' => $this->toolInterface->upperCase($value['fdnoment']), 'correct_option' => 0];
        }

        $correctOption = ['option' => $this->toolInterface->upperCase($customerFinancialHousingCredit[0]['fdnoment']), 'correct_option' => 1];
        array_push($options, $correctOption);

        if ($checkCustomerFinancialHousingCredit) {
            shuffle($options);
        }

        if ($checkCustomerFinancialHousingCredit == false) {
            $options = [];

            $arrearFinancialHousingCredit = $this->cifinFinancialArrearInterface->getNameEntitiesHousingCredit($customerHousingCreditEntities);
            $arrearFinancialHousingCredit = $arrearFinancialHousingCredit->toArray();

            foreach ($arrearFinancialHousingCredit as $value) {
                $options[] = ['option' => $this->toolInterface->upperCase($value['finnoment']), 'correct_option' => 0];
            }

            $correctOption = ['option' => $this->toolInterface->upperCase($customerArrearFinancialHousingCredit[0]['finnoment']), 'correct_option' => 1];
            array_push($options, $correctOption);

            if ($checkCustomerArrearFinancialHousingCredit) {
                shuffle($options);
            }
        }

        if ($checkCustomerFinancialHousingCredit == false && $checkCustomerArrearFinancialHousingCredit == false) {
            $options = [];

            $extintFinancialHousingCredit = $this->extintFinancialCifinInterface->getNameEntitiesHousingCredit($customerHousingCreditEntities);
            $extintFinancialHousingCredit = $extintFinancialHousingCredit->toArray();

            foreach ($extintFinancialHousingCredit as $value) {
                $options[] = ['option' => $this->toolInterface->upperCase($value['extnoment']), 'correct_option' => 0];
            }

            $correctOption = ['option' => $this->toolInterface->upperCase($customerExtintFinancialHousingCredit[0]['extnoment']), 'correct_option' => 1];
            array_push($options, $correctOption);

            if ($checkCustomerExtintFinancialHousingCredit) {
                shuffle($options);
            }
        }

        return $options;
    }

    public function getDataQuestionFive($identificationNumber)
    {
        // 5. CON CUAL DE LAS SIGUIENTES DIRECCIONES HA TENIDO RELACION
        $options              = [];
        $checkCustomerAddress = true;
        $customerAddresses    = [];

        $ubicaAddress = $this->ubicaInterface->getUbicaConsultation($identificationNumber);
        if (count($ubicaAddress->toArray()) > 1) {
            $getCustomerAddresses = $ubicaAddress[0]->ubicAddress;
            $getCustomerAddresses = $getCustomerAddresses->toArray();
        } else {
            $checkCustomerAddress = false;
            $getCustomerAddresses = [['ubidireccion' => 'NINGUNA DE LAS ANTERIORES']];
        }

        foreach ($getCustomerAddresses as $value) {
            $customerAddresses[] = $value['ubidireccion'];
        }

        $addresses = $this->ubicaAddressInterface->getAddresses($customerAddresses);

        foreach ($addresses as $value) {
            $options[] = ['option' => $this->toolInterface->upperCase($value['ubidireccion']), 'correct_option' => 0];
        }

        array_push($options, ['option' => $this->toolInterface->upperCase($getCustomerAddresses[0]['ubidireccion']), 'correct_option' => 1]);

        if ($checkCustomerAddress) {
            shuffle($options);
        }

        return $options;
    }

    public function getDataQuestionSix($identificationNumber)
    {
        // 6. CON CUAL DE LOS SIGUIENTES NUMEROS DE TELEFONO HA TENIDO ALGUNA RELACION
        $options             = [];
        $checkCustomerCellPhones = true;
        $customerCellPhones      = [];

        $ubicaCellPhones = $this->ubicaInterface->getUbicaConsultation($identificationNumber);
        if (count($ubicaCellPhones->toArray()) > 1) {
            $getCustomerCellPhones = $ubicaCellPhones[0]->ubicCellPhones;
            $getCustomerCellPhones = $getCustomerCellPhones->toArray();
        } else {
            $checkCustomerCellPhones = false;
            $getCustomerCellPhones = [['ubicelular' => 'NINGUNA DE LAS ANTERIORES']];
        }

        foreach ($getCustomerCellPhones as $value) {
            $customerCellPhones[] = $value['ubicelular'];
        }

        $cellPhones = $this->ubicaCellPhoneInterface->getCellPhones($customerCellPhones);
        $cellPhones = $cellPhones->toArray();

        foreach ($cellPhones as $value) {
            $options[] = ['option' => $this->toolInterface->upperCase($value['ubicelular']), 'correct_option' => 0];
        }

        array_push($options, ['option' => $this->toolInterface->upperCase($getCustomerCellPhones[0]['ubicelular']), 'correct_option' => 1]);

        if ($checkCustomerCellPhones) {
            shuffle($options);
        }

        return $options;
    }
}