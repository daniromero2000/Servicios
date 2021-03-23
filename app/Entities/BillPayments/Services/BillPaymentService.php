<?php

namespace App\Entities\BillPayments\Services;

use App\Entities\BillPaymentAttachmentLogs\Repositories\BillPaymentAttachmentLogRepositoryInterface;
use App\Entities\BillPayments\Repositories\BillPaymentRepositoryInterface;
use App\Entities\BillPayments\Services\Interfaces\BillPaymentServiceInterface;
use App\Entities\BillPaymentStatusesLogs\Repositories\BillPaymentStatusesLogRepositoryInterface;
use App\Entities\BillPaymentSubsidiaries\BillPaymentSubsidiary;
use App\Entities\MailsBillPayments\Repositories\MailsBillPaymentRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\TelephoneBillPayments\Repositories\TelephoneBillPaymentRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface as InterfacesToolRepositoryInterface;
use App\Entities\TypeInvoices\Repositories\TypeInvoiceRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class BillPaymentService implements BillPaymentServiceInterface
{
    protected $billPaymentInterface, $typeInvoice, $subsidiaryInterface, $mailsBillPaymentInterface;

    public function __construct(
        BillPaymentRepositoryInterface $BillPaymentRespositoryInterface,
        InterfacesToolRepositoryInterface $toolRepositoryInterface,
        TypeInvoiceRepositoryInterface $TypeInvoiceRepositoryInterface,
        SubsidiaryRepositoryInterface $SubsidiaryRepositoryInterface,
        MailsBillPaymentRepositoryInterface $mailsBillPaymentRepositoryInterface,
        BillPaymentStatusesLogRepositoryInterface $BillPaymentStatusesLogRepositoryInterface,
        BillPaymentAttachmentLogRepositoryInterface $BillPaymentAttachmentLogRepositoryInterface,
        TelephoneBillPaymentRepositoryInterface $TelephoneBillPaymentRepositoryInterface
    ) {
        $this->billPaymentInterface      = $BillPaymentRespositoryInterface;
        $this->toolsInterface            = $toolRepositoryInterface;
        $this->typeInvoice               = $TypeInvoiceRepositoryInterface;
        $this->subsidiaryInterface       = $SubsidiaryRepositoryInterface;
        $this->mailsBillPaymentInterface = $mailsBillPaymentRepositoryInterface;
        $this->statusesLogInterface      = $BillPaymentStatusesLogRepositoryInterface;
        $this->billPaymentAttachmentInterface = $BillPaymentAttachmentLogRepositoryInterface;
        $this->telephoneBillPaymentInterface  = $TelephoneBillPaymentRepositoryInterface;
    }

    public function listBillPayments(array $data): array
    {
        $skip               = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $q                  = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $status             = array_key_exists('status', $data['search']) ? $data['search']['status'] : '';
        $payment_deadline   = array_key_exists('payment_deadline', $data['search']) ? $data['search']['payment_deadline'] : '';
        $subsidiary_id      = array_key_exists('subsidiary_id', $data['search']) ? $data['search']['subsidiary_id'] : '';
        $search      = false;

        if ($q != '' || $status != '' || $payment_deadline != '' ||  $subsidiary_id != '') {
            $list     = $this->billPaymentInterface->searchBillPayment($q, $skip * 30, $status, $payment_deadline, $subsidiary_id);
            $paginate = $this->billPaymentInterface->countBillPayments($q, $status, $payment_deadline, $subsidiary_id);
            $search = true;
        } else {
            $list     = $this->billPaymentInterface->listBillPayments($skip * 30);
            $paginate = $this->billPaymentInterface->countBillPayments('');
        }

        $subsidiaries = BillPaymentSubsidiary::all();
        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        $list = $list->map(function ($item) {
            $item->type_of_invoice = $item->typeInvoice->name;

            if ($item->status == 0) {
                $item->status = ['status' => 'Pendiente', 'color' => '#FFFFFF', 'background' => '#ff8d00'];
            } elseif ($item->status == 1) {
                $item->status = ['status' => 'Gestionado', 'color' => '#FFFFFF', 'background' => '#007bff'];
            } elseif ($item->status == 2) {
                $item->status = ['status' => 'Pagado', 'color' => '#FFFFFF', 'background' => '#2ec76b'];
            } elseif ($item->status == 3) {
                $item->status = ['status' => 'Aprobado', 'color' => '#FFFFFF', 'background' => '#2ec76b'];
            } else {
                $item->status = ['status' => 'Revisado por contabilidad', 'color' => '#FFFFFF', 'background' => '#ff8d00'];
            }

            $item->status = collect($item->status);

            if ($item->date_of_notification) {
                $item->notification = 'SI';
            } else {
                $item->notification = 'NO';
            }
            
            $item->subsidiary_id = $item->subsidiary ?  $item->subsidiary->code : 'NA';
            return $item;
        })->all();

        return [
            'data' => [
                'list'               =>  collect($list),
                'optionsRoutes'      => 'admin.' . (request()->segment(2)),
                'headers'            => ['Referencia de pago', 'Proveedor', 'Servicio', 'Sucursal', 'Dia de pago', 'Estado', 'Notificado',  'Opciones', ' '],
                'searchInputs'       => [
                    ['label' => 'Buscar', 'type' => 'text', 'name' => 'q'],
                    [
                        'label' => 'Estado', 'type' => 'select', 'name' => 'status',  'option' => 'name', 'options' => [
                            ['id' => '0', 'name' => 'Pendiente'],
                            ['id' => '1', 'name' => 'Gestionado'],
                            ['id' => '2', 'name' => 'Pagado'],
                        ]
                    ],
                    ['label' => 'Dia de pago', 'type' => 'number', 'name' => 'payment_deadline'],
                    ['label' => 'Sucursal', 'type' => 'select', 'options' =>  $subsidiaries, 'name' => 'subsidiary_id', 'option' => 'code', 'value' => 'code']
                ],
                'inputs' => [
                    ['label' => 'Referencia de pago', 'type' => 'text', 'name' => 'payment_reference'],
                    ['label' => 'Dia limite de pago', 'type' => 'number', 'name' => 'payment_deadline'],
                    ['label' => 'Fecha de vigencia', 'type' => 'date', 'name' => 'time_of_validity'],
                    ['label' => 'Proveedor', 'type' => 'select', 'options' => $this->typeInvoice->listAllTypeInvoices(), 'name' => 'type_of_invoice', 'option' => 'name'],
                    ['label' => 'Sucursal', 'type' => 'select', 'options' =>  $subsidiaries, 'name' => 'subsidiary_id', 'option' => 'code', 'test' => 'code'],
                    ['label' => 'Estado', 'type' => 'select', 'name' => 'status', 'options' => [
                        ['id' => '0', 'name' => 'Pendiente'],
                        ['id' => '1', 'name' => 'Gestionado'],
                        ['id' => '3', 'name' => 'Aprobado'],
                        ['id' => '4', 'name' => 'Revisado por contabilidad'],
                        ['id' => '2', 'name' => 'Pagado']
                    ], 'option' => 'name'],
                    ['label' => 'Tipo de servicio', 'type' => 'select', 'name' => 'type_of_service', 'options' => [
                        ['id' => 'Acueducto', 'name' => 'Acueducto'],
                        ['id' => 'Bolsa de minutos', 'name' => 'Bolsa de minutos'],
                        ['id' => 'Energia', 'name' => 'Energia'],
                        ['id' => 'Internet', 'name' => 'Internet'],
                        ['id' => 'Internet y telefonía', 'name' => 'Internet y telefonía'],
                        ['id' => 'PDTI', 'name' => 'PDTI'],
                        ['id' => 'Telefonia (Fijo)', 'name' => 'Telefonia (Fijo)'],
                        ['id' => 'Telefonia (Movil)', 'name' => 'Telefonia (Movil)'],
                        ['id' => 'Todos los servicios', 'name' => 'Todos los servicios']
                    ], 'option' => 'name'],
                ],
                'skip'               => $skip,
                'paginate'           => $getPaginate['paginate'],
                'position'           => $getPaginate['position'],
                'page'               => $getPaginate['page'],
                'limit'              => $getPaginate['limit'],
                'button'             => true,
            ],
            'search'  => $search
        ];
    }

    public function listBillPaymentsForArea(array $data): array
    {
        $skip               = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $q                  = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $status             = array_key_exists('status', $data['search']) ? $data['search']['status'] : '';
        $payment_deadline   = array_key_exists('payment_deadline', $data['search']) ? $data['search']['payment_deadline'] : '';
        $subsidiary_id      = array_key_exists('subsidiary_id', $data['search']) ? $data['search']['subsidiary_id'] : '';
        $search      = false;

        if ($q != '' || $status != '' || $payment_deadline != '' ||  $subsidiary_id != '') {
            $list     = $this->billPaymentInterface->searchBillPayment($q, $skip * 30, $data['status'], $payment_deadline, $subsidiary_id);
            $paginate = $this->billPaymentInterface->countBillPayments($q, $data['status'], $payment_deadline, $subsidiary_id);
            $search = true;
        } else {
            $list     = $this->billPaymentInterface->searchBillPayment($q, $skip * 30, $data['status']);
            $paginate = $this->billPaymentInterface->countBillPayments('');
        }

        $subsidiaries = BillPaymentSubsidiary::all();
        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $skip);

        $list = $list->map(function ($item) {
            $item->type_of_invoice = $item->typeInvoice->name;

            if ($item->status == 0) {
                $item->status = ['status' => 'Pendiente', 'color' => '#FFFFFF', 'background' => '#ff8d00'];
            } elseif ($item->status == 1) {
                $item->status = ['status' => 'Gestionado', 'color' => '#FFFFFF', 'background' => '#007bff'];
            } elseif ($item->status == 2) {
                $item->status = ['status' => 'Pagado', 'color' => '#FFFFFF', 'background' => '#2ec76b'];
            } elseif ($item->status == 3) {
                $item->status = ['status' => 'Aprobado', 'color' => '#FFFFFF', 'background' => '#2ec76b'];
            } else {
                $item->status = ['status' => 'Revisado por contabilidad', 'color' => '#FFFFFF', 'background' => '#ff8d00'];
            }

            $item->status = collect($item->status);

            if ($item->date_of_notification) {
                $item->notification = 'SI';
            } else {
                $item->notification = 'NO';
            }
            return $item;
        })->all();

        $subsidiaries = $subsidiaries->map(function ($item) {
            $item->id = $item->code;
            return $item;
        })->all();

        return [
            'data' => [
                'list'               =>  collect($list),
                'optionsRoutes'      => 'admin.' . (request()->segment(2)),
                'headers'            => ['Referencia de pago', 'Proveedor', 'Servicio', 'Sucursal', 'Dia de pago', 'Estado', 'Notificado',  'Opciones'],
                'searchInputs'       => [
                    ['label' => 'Buscar', 'type' => 'text', 'name' => 'q'],
                    ['label' => 'Dia de pago', 'type' => 'number', 'name' => 'payment_deadline'],
                    ['label' => 'Sucursal', 'type' => 'select', 'options' => collect($subsidiaries), 'name' => 'subsidiary_id', 'option' => 'code', 'value' => 'code']
                ],
                'inputs' => [
                    ['label' => 'Referencia de pago', 'type' => 'text', 'name' => 'payment_reference'],
                    ['label' => 'Dia limite de pago', 'type' => 'number', 'name' => 'payment_deadline'],
                    ['label' => 'Proveedor', 'type' => 'select', 'options' => $this->typeInvoice->listAllTypeInvoices(), 'name' => 'type_of_invoice', 'option' => 'name'],
                    ['label' => 'Sucursal', 'type' => 'select', 'options' => collect($subsidiaries), 'name' => 'subsidiary_id', 'option' => 'code' ],
                    ['label' => 'Estado', 'type' => 'select', 'name' => 'status', 'options' => [
                        ['id' => '4', 'name' => 'Aprobado'],
                        ['id' => '5', 'name' => 'Revisado por contabilidad'],
                    ], 'option' => 'name'],
                    ['label' => 'Tipo de servicio', 'type' => 'select', 'name' => 'type_of_service', 'options' => [
                        ['id' => 'Acueducto', 'name' => 'Acueducto'],
                        ['id' => 'Bolsa de minutos', 'name' => 'Bolsa de minutos'],
                        ['id' => 'Energia', 'name' => 'Energia'],
                        ['id' => 'Internet', 'name' => 'Internet'],
                        ['id' => 'Internet y telefonía', 'name' => 'Internet y telefonía'],
                        ['id' => 'PDTI', 'name' => 'PDTI'],
                        ['id' => 'Telefonia (Fijo)', 'name' => 'Telefonia (Fijo)'],
                        ['id' => 'Telefonia (Movil)', 'name' => 'Telefonia (Movil)'],
                        ['id' => 'Todos los servicios', 'name' => 'Todos los servicios']
                    ], 'option' => 'name'],
                ],
                'skip'               => $skip,
                'paginate'           => $getPaginate['paginate'],
                'position'           => $getPaginate['position'],
                'page'               => $getPaginate['page'],
                'limit'              => $getPaginate['limit'],
            ],
            'search'  => $search
        ];
    }

    public function createBillPayment()
    {
        return ['data' => [
            'typeInvoices' => $this->typeInvoice->listAllTypeInvoices(),
            'subsidiaries' => BillPaymentSubsidiary::all()

        ]];
    }

    public function saveBillPayment(array $data): bool
    {
        $billPayment = $this->billPaymentInterface->createBillPayment($data);

        foreach ($data['emails'] as $key => $value) {
            $dataMail = ['bill_payment_id' => $billPayment->id, 'email' => $value];
            $this->mailsBillPaymentInterface->createMailsBillPayment($dataMail);
        }

        if (array_key_exists('telephones', $data)) {
            foreach ($data['telephones'] as $key => $value) {
                if ($value) {
                    $dataTelephones = ['bill_payment_id' => $billPayment->id, 'telephone' => $value];
                    $this->telephoneBillPaymentInterface->createTelephoneBillPayment($dataTelephones);
                }
            }
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

    public function saveDocumentFile($data): string
    {
        $document = $this->billPaymentInterface->saveDocumentFile($data);

        return $document;
    }


    public function updateBillPayment(array $data)
    {
        $billPayment = $this->billPaymentInterface->findBillPaymentById($data['id']);

        $this->billPaymentInterface->updateBillPayment($data);

        if (array_key_exists('src_invoice', $data['data'])) {
            $user = auth()->user()->id;
            $src_invoice = [
                'bill_payment_id' => $billPayment->id,
                'src_invoice'     => $data['data']['src_invoice'],
                'user_id'         => $user
            ];

            $this->billPaymentAttachmentInterface->createBillPaymentAttachmentLog($src_invoice);
        }

        if (array_key_exists('emails', $data['data'])) {
            $this->mailsBillPaymentInterface->destroyMailsBillPaymen($data['id']);

            foreach ($data['data']['emails'] as $key => $value) {
                $mails = ['bill_payment_id' => $data['id'], 'email' => $value];
                $this->mailsBillPaymentInterface->createMailsBillPayment($mails);
            }
        }

        if (array_key_exists('telephones', $data['data'])) {
            $this->telephoneBillPaymentInterface->destroyTelephoneBillPaymen($data['id']);

            foreach ($data['data']['telephones'] as $key => $value) {
                $dataTelephones = ['bill_payment_id' => $billPayment->id, 'telephone' => $value];
                $this->telephoneBillPaymentInterface->createTelephoneBillPayment($dataTelephones);
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
                        $email = $mail->email ? $mail->email : 'auditoria05-per@lagobo.com';
                        $this->billPaymentInterface->sendNotificationOfInvoicePaid($email, $billPayment);
                    }
                }
            }
        }
        return $billPayment;
    }

    public function findBillPaymentById(int $id)
    {
        $data = $this->billPaymentInterface->findBillPaymentById($id);

        $weekMap = [
            0 => 'SU',
            1 => 'MO',
            2 => 'TU',
            3 => 'WE',
            4 => 'TH',
            5 => 'FR',
            6 => 'SA',
        ];

        foreach ($data->statusLogs as $key => $value) {
            $date1 =  $data->statusLogs[$key]->created_at;
            if (isset($data->statusLogs[$key + 1]->created_at)) {
                $date2 =  $data->statusLogs[$key + 1]->created_at;
                $secondsDays = ($date1->diffInSeconds($date2)) / 28800;
                if ($weekMap[$date1->dayOfWeek] != 'SU') {
                    if ($secondsDays > 1 && $secondsDays < 3) {
                        $secondsDays = $secondsDays - 1;
                        $removeSeconds = $secondsDays * 28800;
                        $value->diffTime = $date1->diffInSeconds($date2);
                        $value->diffTime =  $value->diffTime - $removeSeconds;
                        $value->diffTime = Carbon::now()->subSeconds($value->diffTime)->diffForHumans(null, true, null, 3);
                    } else {
                        $value->diffTime = $date1->diffInSeconds($date2);
                        $value->diffTime = Carbon::now()->subSeconds($value->diffTime)->diffForHumans(null, true, null, 3);
                    }
                }
            }
        }

        return ['data' => [
            'typeInvoices' => $this->typeInvoice->listAllTypeInvoices(),
            'subsidiaries' => BillPaymentSubsidiary::all(),
            'billPayment'  => $data
        ]];
    }

    public function deleteBillPayment($id): bool
    {
        $document = $this->billPaymentInterface->findBillPaymentById($id);
        return  $document->delete();
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
            if ($value->date_of_notification) {
                $dateUpdate = Carbon::parse($value->date_of_notification);
                $diff  = $dateUpdate->diffInDays($date2);

                if ($diff >= 10) {
                    $value->status = 0;
                    $value->date_of_notification = null;
                    $value->update();

                    $status = [
                        'bill_payment_id' => $value->id,
                        'status'          => 6,
                        'user_id'         => 1
                    ];

                    $this->statusesLogInterface->createBillPaymentStatusesLog($status);
                }
            }
        }
    }

    public function verifyManagedInvoices()
    {
        $data = $this->billPaymentInterface->getManagedInvoices();
        $date2 = Carbon::now();

        foreach ($data as $key => $value) {
            $dateUpdate = Carbon::parse($value->statusLog->created_at);
            $diff  = $dateUpdate->diffInDays($date2);

            if ($diff >= 5) {
                $this->billPaymentInterface->sendManagedInvoiceNotification($value);
            }
        }
    }

    public function checkValidityTime()
    {
        $date = Carbon::now();
        $this->billPaymentInterface->checkValidityTime($date);
    }

    public function downloadDocument($id)
    {
        $billPayment = $this->billPaymentInterface->findBillPaymentById($id);

        $file = "storage/" . $billPayment->src_invoice;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $billPayment->payment_reference . '.pdf', $headers);
    }

    public function downloadDocumentLog($id)
    {
        $billPayment = $this->billPaymentAttachmentInterface->findBillPaymentAttachmentLogById($id);

        $file = "storage/" . $billPayment->src_invoice;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $billPayment->created_at . '.pdf', $headers);
    }
}
