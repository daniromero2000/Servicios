<?php

namespace App\Entities\BillPayments\Services;

use App\Entities\BillPayments\Repositories\BillPaymentRepositoryInterface;
use App\Entities\BillPayments\Services\Interfaces\BillPaymentServiceInterface;
use App\Entities\BillPaymentStatusesLogs\Repositories\BillPaymentStatusesLogRepositoryInterface;
use App\Entities\MailsBillPayments\Repositories\MailsBillPaymentRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface as InterfacesToolRepositoryInterface;
use App\Entities\TypeInvoices\Repositories\TypeInvoiceRepositoryInterface;
use Carbon\Carbon;

class BillPaymentService implements BillPaymentServiceInterface
{
    protected $billPaymentInterface, $typeInvoice, $subsidiaryInterface, $mailsBillPaymentInterface;

    public function __construct(
        BillPaymentRepositoryInterface $BillPaymentRespositoryInterface,
        InterfacesToolRepositoryInterface $toolRepositoryInterface,
        TypeInvoiceRepositoryInterface $TypeInvoiceRepositoryInterface,
        SubsidiaryRepositoryInterface $SubsidiaryRepositoryInterface,
        MailsBillPaymentRepositoryInterface $mailsBillPaymentRepositoryInterface,
        BillPaymentStatusesLogRepositoryInterface $BillPaymentStatusesLogRepositoryInterface
    ) {
        $this->billPaymentInterface      = $BillPaymentRespositoryInterface;
        $this->toolsInterface            = $toolRepositoryInterface;
        $this->typeInvoice               = $TypeInvoiceRepositoryInterface;
        $this->subsidiaryInterface       = $SubsidiaryRepositoryInterface;
        $this->mailsBillPaymentInterface = $mailsBillPaymentRepositoryInterface;
        $this->statusesLogInterface      = $BillPaymentStatusesLogRepositoryInterface;
    }

    public function listBillPayments(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) &&  $data['search']['from'] != '' ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) &&  $data['search']['to'] != '' ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->billPaymentInterface->searchBillPayment($q, $skip * 30);
            $paginate = $this->billPaymentInterface->countBillPayments($q);
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->billPaymentInterface->searchBillPayment($q, $skip * 30, $from, $to);
            $paginate = $this->billPaymentInterface->countBillPayments($q, $from, $to);
            $search = true;
        } else {
            $list     = $this->billPaymentInterface->listBillPayments($skip * 30);
            $paginate = $this->billPaymentInterface->countBillPayments('');
        }

        $subsidiaries = $this->subsidiaryInterface->getSubsidiares();
        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        $list = $list->map(function ($item) {
            $item->type_of_invoice = $item->typeInvoice->name;

            if ($item->status == 0) {
                $item->status = ['status' => 'Pendiente', 'color' => '#FFFFFF', 'background' => '#ff8d00'];
            } elseif ($item->status == 1) {
                $item->status = ['status' => 'Gestionado', 'color' => '#FFFFFF', 'background' => '#007bff'];
            } else {
                $item->status = ['status' => 'Pagado', 'color' => '#FFFFFF', 'background' => '#2ec76b'];
            }
            $item->status = collect($item->status);
            return $item;
        })->all();

        $subsidiaries = $subsidiaries->map(function ($item) {
            $item->id = $item->CODIGO;
            return $item;
        })->all();

        return [
            'data' => [
                'list'               =>  collect($list),
                'optionsRoutes'      => 'admin.' . (request()->segment(2)),
                'headers'            => ['Referencia de pago', 'Proveedor', 'Servicio', 'Sucursal', 'Dia de corte', 'Estado', 'Opciones'],
                'searchInputs'       => [
                    ['label' => 'Buscar', 'type' => 'text', 'name' => 'q'],
                    ['label' => 'Desde', 'type' => 'date', 'name' => 'from'],
                    ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']
                ],
                'inputs' => [
                    ['label' => 'Referencia de pago', 'type' => 'text', 'name' => 'payment_reference'],
                    ['label' => 'Dia limite de pago', 'type' => 'number', 'name' => 'payment_deadline'],
                    ['label' => 'Proveedor', 'type' => 'select', 'options' => $this->typeInvoice->listAllTypeInvoices(), 'name' => 'type_of_invoice', 'option' => 'name'],
                    ['label' => 'Sucursal', 'type' => 'select', 'options' => collect($subsidiaries), 'name' => 'subsidiary_id', 'option' => 'CODIGO'],
                    ['label' => 'Estado', 'type' => 'select', 'name' => 'status', 'options' => [
                        ['id' => '0', 'name' => 'Pendiente'],
                        ['id' => '1', 'name' => 'Gestionado'],
                        ['id' => '2', 'name' => 'Pagado']
                    ], 'option' => 'name'],
                    ['label' => 'Tipo de servicio', 'type' => 'select', 'name' => 'type_of_service', 'options' => [
                        ['id' => 'Internet', 'name' => 'Internet'],
                        ['id' => 'Telefonia (Fijo)', 'name' => 'Telefonia (Fijo)'],
                        ['id' => 'Telefonia (Movil)', 'name' => 'Telefonia (Movil)'],
                        ['id' => 'Energia', 'name' => 'Energia'],
                        ['id' => 'Agua', 'name' => 'Agua']
                    ], 'option' => 'name'],
                ],
                'skip'               => $skip,
                'paginate'           => $getPaginate['paginate'],
                'position'           => $getPaginate['position'],
                'page'               => $getPaginate['page'],
                'limit'              => $getPaginate['limit']
            ],
            'search'  => $search
        ];
    }

    public function createBillPayment()
    {
        return ['data' => [
            'typeInvoices' => $this->typeInvoice->listAllTypeInvoices(),
            'subsidiaries'   => $this->subsidiaryInterface->getSubsidiares()
        ]];
    }

    public function saveBillPayment(array $data): bool
    {
        $billPayment = $this->billPaymentInterface->createBillPayment($data);

        foreach ($data['emails'] as $key => $value) {
            $data = ['bill_payment_id' => $billPayment->id, 'email' => $value];

            $this->mailsBillPaymentInterface->createMailsBillPayment($data);
        }

        $user = auth()->user()->id;
        $status = [
            'bill_payment_id' => $billPayment->id,
            'status'          => 0,
            'user_id'         => $user
        ];

        $this->statusesLogInterface->createBillPaymentStatusesLog($status);

        return true;
    }

    public function updateBillPayment(array $data): bool
    {
        $billPayment = $this->billPaymentInterface->findBillPaymentById($data['id']);

        $this->billPaymentInterface->updateBillPayment($data);

        if (array_key_exists('emails', $data['data'])) {

            $this->mailsBillPaymentInterface->destroyMailsBillPaymen($data['id']);

            foreach ($data['data']['emails'] as $key => $value) {
                $mails = ['bill_payment_id' => $data['id'], 'email' => $value];
                $this->mailsBillPaymentInterface->createMailsBillPayment($mails);
            }
        }

        if (array_key_exists('status', $data['data'])) {
            if ($data['data']['status'] != $billPayment->status) {
                $user = auth()->user()->id;
                $status = [
                    'bill_payment_id' => $data['id'],
                    'status'          => $data['data']['status'],
                    'user_id'         => $user
                ];

                $this->statusesLogInterface->createBillPaymentStatusesLog($status);

                if ($data['data']['status'] == 2) {
                    foreach ($billPayment->mailBillPayment as $key => $mail) {
                        $this->billPaymentInterface->sendNotificationOfInvoicePaid($mail->email, $billPayment);
                    }
                }
            }
        }
        return true;
    }

    public function findBillPaymentById(int $id)
    {
        return ['data' => [
            'typeInvoices' => $this->typeInvoice->listAllTypeInvoices(),
            'subsidiaries' => $this->subsidiaryInterface->getSubsidiares(),
            'billPayment'  => $this->billPaymentInterface->findBillPaymentById($id)
        ]];
    }

    public function deleteNotificationById($id): bool
    {
        return true;
    }

    public function checkInvoices()
    {
        $date = Carbon::now();
        return $this->billPaymentInterface->lookUpPastDueBills($date->day);
    }


    public function enableInvoicesForPayment()
    {
        $data = $this->billPaymentInterface->getInvoicesPaid();
        $date2 = Carbon::now();

        foreach ($data as $key => $value) {
            $date = Carbon::createMidnightDate($value->statusLogsPayment->updated_at->year, $value->statusLogsPayment->updated_at->month, $value->payment_deadline);
            $diff  = $date->diffInDays($date2);
            if ($diff >= 10) {
                $value->status = 0;
                $value->update();

                $status = [
                    'bill_payment_id' => $value->id,
                    'status'          => 3,
                    'user_id'         => 1
                ];

                $this->statusesLogInterface->createBillPaymentStatusesLog($status);
            }
        }
    }
}
