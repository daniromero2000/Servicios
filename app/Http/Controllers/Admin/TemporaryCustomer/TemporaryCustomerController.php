<?php

namespace App\Http\Controllers\Admin\TemporaryCustomer;

use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\TemporaryCustomers\Repositories\Interfaces\TemporaryCustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TemporaryCustomerController extends Controller
{
    private $temporaryCustomerInterface;

    public function __construct(
        TemporaryCustomerRepositoryInterface $temporaryCustomerRepositoryInterface
    )
    {
        $this->temporaryCustomerInterface = $temporaryCustomerRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request['FEC_ING'] = ($request['FEC_ING'] != '') ? $request['FEC_ING'].'-01' : '' ;
        $request['FEC_CONST'] = ($request['FEC_CONST'] != '') ? $request['FEC_CONST'].'-01' : '' ;
        return $this->temporaryCustomerInterface->updateOrCreateTemporaryCustomer($request->input());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return response()->json($this->temporaryCustomerInterface->deleteTemporaryCustomer($id));
    }
}
