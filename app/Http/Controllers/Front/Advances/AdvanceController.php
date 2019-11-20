<?php

namespace App\Http\Controllers\Front\Advances;


use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\UpToDateCifins\Repositories\Interfaces\UpToDateCifinRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AdvanceController extends Controller
{
    private $leadInterface, $subsidiaryInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        UpToDateCifinRepositoryInterface $upToDateCifinRepositoryInterface
    ) {
        $this->leadInterface       = $leadRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->customerInterface = $customerRepositoryInterface;
        $this->uptodateInterface = $upToDateCifinRepositoryInterface;
    }


    private function applyTrim($charItem)
    {
        $charTrim = trim($charItem);
        return $charTrim;
    }
    public function index()
    {
        // // Negacion, condicion 1, vectores comportamiento
        // $queryVectores = sprintf("SELECT fdcompor, fdconsul FROM `cifin_findia` WHERE `fdconsul` = (SELECT MAX(`fdconsul`) FROM `cifin_findia` WHERE `fdcedula` = '%s' ) AND `fdcedula` = '%s' AND `fdtipocon` != 'SRV' ", 1088019814, 1088019814);
        // $respVectores = DB::connection('oportudata')->select($queryVectores);

        // $aprobado = false;
        // foreach ($respVectores as $key => $payment) {
        //     $aprobado = false;
        //     $paymentArray = explode('|', $payment->fdcompor);
        //     $paymentArray = array_map(array($this, 'applyTrim'), $paymentArray);
        //     $paymentArray = array_reverse($paymentArray);
        //     $paymentArray = array_splice($paymentArray, 0, 12);
        //     $elementsPaymentExt = array_keys($paymentArray, 'N');
        //     $paymentsExtNumber = count($elementsPaymentExt);


        //     if ($paymentsExtNumber == 12) {
        //         $aprobado = true;
        //         break;
        //     }
        // }
        // dd($paymentsExtNumber);
        // if ($aprobado == false) {
        //     return -1; // Credito negado
        // }
        // dd($aprobado);

        $aprobado =  $this->uptodateInterface->check12MonthsPaymentVector(1088019814);

        if ($aprobado == false) {
            return -1; // Credito negado
        }

        return view('advance.index', [
            'images' => Imagenes::selectRaw('*')->where('category', '=', '3')->where('isSlide', '=', '1')->get(),
            'cities' => $this->subsidiaryInterface->getAllSubsidiaryCityNames()
        ]);
    }

    public function store(Request $request)
    {
        $this->leadInterface->createLead($request->input());
        return redirect()->route('thankYouPageAvance');
    }
}
