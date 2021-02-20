<?php

namespace App\Entities\BillPayments\Repositories;

use App\Entities\BillPayments\BillPayment;
use App\Entities\BillPayments\Exceptions\BillPaymentNotFoundErrorException;
use App\Entities\BillPayments\Exceptions\CreateBillPaymentErrorException;
use App\Mail\BillPayments\Mail as BillPaymentsMail;
use App\Mail\BillPayments\SendNotificationOfInvoicePaid;
use App\Mail\SendEmail;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;

class BillPaymentRepository implements BillPaymentRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'payment_reference',
        'type_of_invoice',
        'type_of_service',
        'subsidiary_id',
        'payment_deadline',
        'status'
        // 'description'
    ];

    public function __construct(BillPayment $billPayment)
    {
        $this->model = $billPayment;
    }

    public function listBillPayments($totalView)
    {
        return $this->model->orderBy('id', 'desc')
            ->skip($totalView)
            ->take(30)
            ->get($this->columns);
    }

    public function createBillPayment(array $data): BillPayment
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateBillPaymentErrorException($e);
        }
    }

    public function searchBillPayment(string $text = null, int $totalView, $from = null, $to = null)
    {
        try {

            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listBillPayments($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchBillPayment($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (empty($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchBillPayment($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countBillPayments(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchBillPayment($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchBillPayment($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function findBillPaymentById(int $id): BillPayment
    {
        try {
            return $this->model->with('mailBillPayment', 'statusLogs')->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            throw new BillPaymentNotFoundErrorException($e);
        }
    }

    public function updateBillPayment(array $params)
    {
        try {

            $billPayment = $this->findBillPaymentById($params['id']);
            $billPayment->update($params['data']);

            return $billPayment;
        } catch (QueryException $e) {
            // throw new UpdateCampaignErrorException($e);
        }
    }

    public function deleteNotificationById($id): bool
    {
        try {
            $data = $this->findBillPaymentById($id);
            return $data->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function lookUpPastDueBills($day)
    {
        $data = $this->checkOverdueInvoices($day);

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                foreach ($value->mailBillPayment as $key => $mail) {
                    $this->sendNotificationOfPastDueInvoice($mail->email, $value);
                }

                $value->date_of_notification = Carbon::now();
                $value->update();
            }
        }
    }

    public function checkOverdueInvoices($day)
    {
        try {
            return $this->model->whereBetween('payment_deadline', [$day, $day + 5])
                // ->orWhereBetween('payment_deadline', [$day - 5, $day])
                ->where('status', 0)
                ->with('mailBillPayment')
                ->with('typeInvoice')
                ->orderBy('payment_deadline', 'ASC')
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getInvoicesPaid()
    {
        try {
            return $this->model->where('status', 2)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function sendNotificationOfPastDueInvoice($mail, $data)
    {
        $date = Carbon::now();
        Mail::to(['email' => $mail])->send(new BillPaymentsMail(['data' => $data, 'date' => $date]));
    }

    public function sendNotificationOfInvoicePaid($mail, $data)
    {
        $date = Carbon::now();
        Mail::to(['email' => $mail])->send(new SendNotificationOfInvoicePaid(['data' => $data, 'date' => $date]));
    }
}
