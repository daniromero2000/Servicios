<?php

namespace App\Http\Controllers\Front\Advances;


use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Imagenes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\Punishments\Repositories\Interfaces\PunishmentRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;

class AdvanceController extends Controller
{
    private $leadInterface, $subsidiaryInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        PunishmentRepositoryInterface $punishmentRepositoryInterface
    ) {
        $this->leadInterface       = $leadRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->customerInterface = $customerRepositoryInterface;
        $this->punishmentInterface = $punishmentRepositoryInterface;
    }

    public function index()
    {
        dd($this->punishmentInterface->checkCustomerIsPunished(1088019814));
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
