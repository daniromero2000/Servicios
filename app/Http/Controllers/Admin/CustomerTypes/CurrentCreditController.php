<?php

namespace App\Http\Controllers\Admin\CustomerTypes;

use App\Http\Controllers\Controller;
use App\Entities\CurrentCredits\Repositories\Interfaces\CurrentCreditRepositoryInterface;
use App\Entities\Obligations\Repositories\Interfaces\ObligationRepositoryInterface;
use App\Entities\ExpiredCredits\Repositories\Interfaces\ExpiredCreditRepositoryInterface;
use App\Entities\SummaryCredits\Repositories\Interfaces\SummaryCreditRepositoryInterface;
use App\Entities\CustomerTypes\Repositories\Interfaces\CustomerTypeRepositoryInterface;
use App\Entities\PaymentTimeCustomers\Repositories\Interfaces\PaymentTimeCustomerRepositoryInterface;

class CurrentCreditController extends Controller
{
    private $currentcreditInterface, $obligationInterface, $expiredcreditInterface, $paymentInterface, $customertypeInterface, $summarycreditInterface;

    public function __construct(
        CurrentCreditRepositoryInterface $currentcreditRepositoryInterface,
        ObligationRepositoryInterface $obligationRepositoryInterface,
        ExpiredCreditRepositoryInterface $expiredcreditRepositoryInterface,
        PaymentTimeCustomerRepositoryInterface $paymentRepositoryInterface,
        SummaryCreditRepositoryInterface $summarycreditRepositoryInterface,
        CustomerTypeRepositoryInterface $customertypeRepositoryInterface
    ) {
        $this->currentcreditInterface = $currentcreditRepositoryInterface;
        $this->obligationInterface    = $obligationRepositoryInterface;
        $this->expiredcreditInterface = $expiredcreditRepositoryInterface;
        $this->paymentInterface       = $paymentRepositoryInterface;
        $this->customertypeInterface  = $customertypeRepositoryInterface;
        $this->summarycreditInterface = $summarycreditRepositoryInterface;
    }

    public function show($identificationNumber)
    {
        return view('customertype.show', [
            'obligation'    =>  $this->obligationInterface->findObligation($identificationNumber),
            'currentcredit' =>  $this->currentcreditInterface->findCurrentCredit($identificationNumber),
            'expiredcredit' =>  $this->expiredcreditInterface->findExpiredCredit($identificationNumber),
            'payment'       =>  $this->paymentInterface->findPaymentTime($identificationNumber),
            'customertype'  =>  $this->customertypeInterface->findCustomerType($identificationNumber),
            'summary'       =>  $this->summarycreditInterface->findSummaryCredit($identificationNumber)
        ]);
    }
}