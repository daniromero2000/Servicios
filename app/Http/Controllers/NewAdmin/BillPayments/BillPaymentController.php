<?php

namespace App\Http\Controllers\NewAdmin\BillPayments;

use App\Entities\BillPayments\Services\Interfaces\BillPaymentServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

class BillPaymentController extends Controller
{
    private $billPaymentInterface, $toolsInterface;

    public function __construct(
        BillPaymentServiceInterface $BillPaymentServiceInterface
    ) {
        $this->billPaymentInterface = $BillPaymentServiceInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = $this->billPaymentInterface->listBillPayments(['search' => request()->input()]);

        if ($response['search']) {
            $request->session()->flash('message', 'Resultado de la Busqueda');
        }

        return view('newAdmin.billPayments.list', $response['data']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data =  $this->billPaymentInterface->createBillPayment();
        return view('newAdmin.billPayments.create', $data['data']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->billPaymentInterface->saveBillPayment($request->except('_token', '_method'));

        return redirect()->route('admin.invoiceManagement.index')->with('message', 'Creación Exitosa');
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
        //
    }
}
