<?php

namespace App\Http\Controllers\Admin\CreditLiquidator;

use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\OportudataLogs\OportudataLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CreditLiquidatorController extends Controller
{
    private $CustomerInterface, $toolsInterface;

    public function __construct(
        CustomerRepositoryInterface $CustomerRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->CustomerInterface = $CustomerRepositoryInterface;
        $this->toolsInterface    = $toolRepositoryInterface;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('creditLiquidator.index');
    }

    public function store(Request $request)
    {
    }

    public function show(int $id)
    {
    }

    public function getProduct(int $code)
    {
    }
}