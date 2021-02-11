<?php

namespace App\Entities\BillPayments\Services;

use App\Entities\BillPayments\Repositories\BillPaymentRepositoryInterface;
use App\Entities\BillPayments\Services\Interfaces\BillPaymentServiceInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface as InterfacesToolRepositoryInterface;
use App\Entities\TypeInvoices\Repositories\TypeInvoiceRepositoryInterface;
use Carbon\Carbon;

class BillPaymentService implements BillPaymentServiceInterface
{
    protected $billPaymentInterface, $typeInvoice, $subsidiaryInterface;

    public function __construct(
        BillPaymentRepositoryInterface $BillPaymentRespositoryInterface,
        InterfacesToolRepositoryInterface $toolRepositoryInterface,
        TypeInvoiceRepositoryInterface $TypeInvoiceRepositoryInterface,
        SubsidiaryRepositoryInterface $SubsidiaryRepositoryInterface
    )
    {
        $this->billPaymentInterface = $BillPaymentRespositoryInterface;
        $this->toolsInterface       = $toolRepositoryInterface;
        $this->typeInvoice          = $TypeInvoiceRepositoryInterface;
        $this->subsidiaryInterface  = $SubsidiaryRepositoryInterface;

    }

    public function listBillPayments(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) ? $data['search']['to'] . " 23:59:59" : '';
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

        $list = $list->map(function ($item) {
            if ($item->status == 0) {
                $item->status = ['status' => 'Inactivo', 'color' => '#FFFFFF', 'background' => '#007bff'];
            } else {
                $item->status = ['status' => 'Activo', 'color' => '#FFFFFF', 'background' => '#007bff'];
            }
            $item->status = collect($item->status);
            return $item;
        })->all();

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'list'               =>  collect($list),
                'optionsRoutes'      => 'admin.' . (request()->segment(2)),
                'headers'            => ['Solicitante', 'Campaña', 'Estado', 'Descripción', 'Opciones'],
                'searchInputs'       => [
                    ['label' => 'Buscar', 'type' => 'text', 'name' => 'q'],
                    ['label' => 'Desde', 'type' => 'date', 'name' => 'from'],
                    ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']
                ],
                'inputs' => [
                    ['label' => 'Campaña', 'type' => 'text', 'name' => 'campaign'],
                    ['label' => 'Estado', 'type' => 'select', 'name' => 'status', 'options' => [
                        ['id' => '1', 'name' => 'Aprobado'],
                        ['id' => '0', 'name' => 'Pendiente'],
                        ['id' => '2', 'name' => 'Negado']
                    ], 'option' => 'name']
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
        $this->billPaymentInterface->createBillPayment($data);
        return true;
    }

    public function findBillPaymentById(int $id)
    {
        return '';
    }

    public function deleteNotificationById($id): bool
    {
        return true;
    }
}
