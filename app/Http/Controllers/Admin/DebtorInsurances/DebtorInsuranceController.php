<?php

namespace App\Http\Controllers\Admin\DebtorInsurances;

use App\Entities\Intentions\Repositories\Interfaces\IntentionRepositoryInterface;
use App\Entities\IntentionStatuses\Repositories\Interfaces\IntentionStatusRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\DebtorInsurances\UseCases\UpdateDebtorInsurance;
use App\Entities\OportudataLogs\UseCases\CreateOportudataLog;

class DebtorInsuranceController extends Controller
{
    private $intentionStatusesInterface, $intentionInterface, $toolsInterface;

    public function __construct(
        IntentionRepositoryInterface $intentionRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        IntentionStatusRepositoryInterface $intentionStatusRepositoryInterface
    ) {
        $this->intentionInterface = $intentionRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->intentionStatusesInterface = $intentionStatusRepositoryInterface;
        $this->middleware('auth');
    }


    public function store(Request $request)
    {
        $updateDebtorInsurance =  new UpdateDebtorInsurance();
        $updateDebtorInsurance->execute($request);

        $createOportudataLog = new CreateOportudataLog();
        $createOportudataLog->execute($request->input('SOLIC'));

        $notification = 1;
        return view('customers.updatePolicyDebtor', ['notification' => $notification]);
    }
}
