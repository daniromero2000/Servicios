<?php

namespace App\Http\Controllers\NewAdmin\BillPayments;

use App\Entities\BillPayments\Services\Interfaces\BillPaymentServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

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
        $data =  $this->billPaymentInterface->findBillPaymentById($id);
        return view('newAdmin.billPayments.edit', $data['data']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $this->billPaymentInterface->updateBillPayment(['data' => $request->except('_token', '_method'), 'id' => $id]);

        return redirect()->route('admin.invoiceManagement.index')->with('message', 'Actualización Exitosa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->billPaymentInterface->deleteBillPayment($id);
        return redirect()->route('admin.invoiceManagement.index')->with('message', 'Se ha eliminado correctamente');
    }

    public function verifyInvoiceExpiration(Request $request)
    {
        // $data = $this->billPaymentInterface->checkInvoices();
        // $date = Carbon::now();
        // return view('mail.billPayment.mail', ['data' => $data[0], 'date' => $date]);
        // return $this->billPaymentInterface->checkInvoices();
    }

    public function resetPaymentStatuses()
    {
        // return $this->billPaymentInterface->enableInvoicesForPayment();
    }
}
