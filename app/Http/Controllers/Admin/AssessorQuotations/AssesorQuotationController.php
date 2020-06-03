<?php

namespace App\Http\Controllers\Admin\AssessorQuotations;

use App\Entities\AssessorQuotations\Repositories\Interfaces\AssessorQuotationRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AssesorQuotationController extends Controller
{
    private $assessorQuotationRepositoryInterface, $toolInterface;

    public function __construct(
        AssessorQuotationRepositoryInterface $assessorQuotationRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->assessorQuotationRepositoryInterface = $assessorQuotationRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
    }

    public function index()
    {
        $to = Carbon::now();
        $from = Carbon::now()->startOfMonth();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show()
    {
        //
    }


    public function edit()
    {
        //
    }


    public function update()
    {
        //
    }


    public function destroy()
    {
        //
    }
}
