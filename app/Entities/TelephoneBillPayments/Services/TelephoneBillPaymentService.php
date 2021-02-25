<?php

namespace App\Entities\MailsBillPayments\Services;

use App\Entities\MailsBillPayments\Repositories\MailsBillPaymentRepositoryInterface;
use App\Entities\MailsBillPayments\Services\Interfaces\MailsBillPaymentServiceInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface as InterfacesToolRepositoryInterface;
use App\Entities\TypeInvoices\Repositories\TypeInvoiceRepositoryInterface;
use Carbon\Carbon;

class MailsBillPaymentService implements MailsBillPaymentServiceInterface
{
    protected $billPaymentInterface, $typeInvoice, $subsidiaryInterface;

    public function __construct(
        MailsBillPaymentRepositoryInterface $MailsBillPaymentRespositoryInterface,
        InterfacesToolRepositoryInterface $toolRepositoryInterface,
        TypeInvoiceRepositoryInterface $TypeInvoiceRepositoryInterface,
        SubsidiaryRepositoryInterface $SubsidiaryRepositoryInterface
    ) {
        $this->billPaymentInterface = $MailsBillPaymentRespositoryInterface;
        $this->toolsInterface       = $toolRepositoryInterface;
        $this->typeInvoice          = $TypeInvoiceRepositoryInterface;
        $this->subsidiaryInterface  = $SubsidiaryRepositoryInterface;
    }

    public function listMailsBillPayments(array $data): array
    {
        $skip        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $fromOrigin  = array_key_exists('from', $data['search']) &&  $data['search']['from'] != '' ? $data['search']['from'] . " 00:00:01" : '';
        $toOrigin    = array_key_exists('to', $data['search']) &&  $data['search']['to'] != '' ? $data['search']['to'] . " 23:59:59" : '';
        $q           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $search      = false;

        if ($q != '' && ($fromOrigin == '' || $toOrigin == '')) {
            $list     = $this->billPaymentInterface->searchMailsBillPayment($q, $skip * 30);
            $paginate = $this->billPaymentInterface->countMailsBillPayments($q);
            $search = true;
        } elseif (($q != '' || $fromOrigin != '' || $toOrigin != '')) {
            $from     = $fromOrigin != '' ? $fromOrigin : Carbon::now()->subMonths(1);
            $to       = $toOrigin != '' ? $toOrigin : Carbon::now();
            $list     = $this->billPaymentInterface->searchMailsBillPayment($q, $skip * 30, $from, $to);
            $paginate = $this->billPaymentInterface->countMailsBillPayments($q, $from, $to);
            $search = true;
        } else {      
            $list     = $this->billPaymentInterface->listMailsBillPayments($skip * 30);
            $paginate = $this->billPaymentInterface->countMailsBillPayments('');
        }

        $list = $list->map(function ($item) {

            $item->type_of_invoice = $item->typeInvoice->name;

            if ($item->status == 0) {
                $item->status = ['status' => 'Pendiente', 'color' => '#FFFFFF', 'background' => '#ff8d00'];
            } elseif($item->status == 1) {
                $item->status = ['status' => 'Gestionado', 'color' => '#FFFFFF', 'background' => '#007bff'];
            }else{
                $item->status = ['status' => 'Pagado', 'color' => '#FFFFFF', 'background' => '#2ec76b'];
            }
            $item->status = collect($item->status);
            return $item;
        })->all();

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        return [
            'data' => [
                'list'               =>  collect($list),
                'optionsRoutes'      => 'admin.' . (request()->segment(2)),
                'headers'            => ['Referencia de pago', 'Tipo de factura', 'Servicio', 'Sucursal', 'Dia de corte', 'Estado', 'Opciones'],
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

    public function createMailsBillPayment()
    {
        return ['data' => [
            'typeInvoices' => $this->typeInvoice->listAllTypeInvoices(),
            'subsidiaries'   => $this->subsidiaryInterface->getSubsidiares()
        ]];
    }

    public function saveMailsBillPayment(array $data): bool
    {
        $this->billPaymentInterface->createMailsBillPayment($data);
        return true;
    }

    public function findMailsBillPaymentById(int $id)
    {
        return '';
    }

    public function deleteNotificationById($id): bool
    {
        return true;
    }
}
