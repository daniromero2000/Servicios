<?php

namespace App\Entities\BillPayments\Repositories;

use App\Entities\BillPayments\BillPayment;
use App\Entities\BillPayments\Exceptions\BillPaymentNotFoundErrorException;
use App\Entities\BillPayments\Exceptions\CreateBillPaymentErrorException;
use App\Mail\BillPayments\Mail as BillPaymentsMail;
use App\Mail\BillPayments\SendExpirationTimeAlert;
use App\Mail\BillPayments\SendManagedInvoiceNotification;
use App\Mail\BillPayments\SendNotificationOfInvoicePaid;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\UploadedFile;

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
        'status',
        'date_of_notification',
        'src_invoice'
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

    public function saveDocumentFile(UploadedFile $file): string
    {
        return $file->store('invoices', ['disk' => 'public']);
    }

    public function searchBillPayment(string $text = null, int $totalView, $status = null, $payment_deadline = null, $subsidiary_id = null)
    {
        try {

            if (empty($text) && is_null($status) && is_null($payment_deadline) && is_null($subsidiary_id)) {
                return $this->listBillPayments($totalView);
            }

            return $this->model->searchBillPayment($text, null, true, true)
                ->when($status, function ($q, $status) {
                    return $q->where('status', $status);
                })
                ->when($payment_deadline, function ($q, $payment_deadline) {
                    return $q->where('payment_deadline', $payment_deadline);
                })
                ->when($subsidiary_id, function ($q, $subsidiary_id) {
                    return $q->where('subsidiary_id', $subsidiary_id);
                })
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countBillPayments(string $text = null, $status = null, $payment_deadline = null, $subsidiary_id = null)
    {
        if (empty($text)) {
            return $this->model->count('id');
        }

        if (!empty($text)) {
            return $this->model->searchBillPayment($text, null, true, true)
                ->count('id');
        }
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
                $diff = $value->payment_deadline - $day;
                if ($diff > 0) {
                    $date = Carbon::now()->addDays($diff);
                } else {
                    $date = Carbon::now();
                }
                foreach ($value->mailBillPayment as $key => $mail) {
                    $email = $mail->email ? $mail->email : 'auditoria05-per@lagobo.com';
                    $this->sendNotificationOfPastDueInvoice($email, $value, $date);
                }
                if ($diff < 3) {
                    foreach ($value->telephoneBillPayment as $key => $telephone) {
                        $this->sendMessageSmsInfobip($value->payment_reference, $date, $telephone->telephone);
                    }
                }
                $value->date_of_notification = Carbon::now();
                $value->update();
            }
        }
    }

    public function checkOverdueInvoices($day)
    {
        try {
            return $this->model->whereBetween('payment_deadline', [$day, $day + 7])
                ->orWhereBetween('payment_deadline', [$day - 5, $day])
                ->where('status', 0)
                ->where('is_active', 1)
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
            return $this->model->where('status', 2)
                ->where('is_active', 1)
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getManagedInvoices()
    {
        try {
            return $this->model->with('statusLog')->where('status', 1)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function checkValidityTime($date)
    {
        try {
            $data = $this->model->where('is_active', 1)->get();
            foreach ($data as $key => $value) {
                if ($value->time_of_validity) {
                    $this->sendExpirationTimeAlert($value);
                    // $value->is_active = 0;
                    // $value->update();
                }
            }

            return $data;
        } catch (QueryException $e) {
            dd($e->getMessage());
            abort(503, $e->getMessage());
        }
    }

    public function sendNotificationOfPastDueInvoice($mail, $data, $date)
    {
        Mail::to(['email' => $mail])->send(new BillPaymentsMail(['data' => $data, 'date' => $date]));
    }

    public function sendNotificationOfInvoicePaid($mail, $data)
    {
        $date = Carbon::now();
        Mail::to(['email' => $mail])->send(new SendNotificationOfInvoicePaid(['data' => $data, 'date' => $date]));
    }

    public function sendManagedInvoiceNotification($data)
    {
        $date = Carbon::now();
        Mail::to(['email' => 'auditoria05-per@lagobo.com'])->send(new SendManagedInvoiceNotification(['data' => $data, 'date' => $date]));
    }

    public function sendExpirationTimeAlert($data)
    {
        $date = Carbon::now();
        Mail::to(['email' => '123romerod@gmail.com'])->send(new SendExpirationTimeAlert(['data' => $data, 'date' => $date]));
    }

    public function sendMessageSmsInfobip($code, $date, $celNumber)
    {
        $text = 'La siguiente factura esta próxima a vencer, por favor gestionar o notificar a la persona responsable. Referencia de pago: ' . $code . ", el cual tiene una limite de pago hasta el dia: " . $date->day . '/' .  $date->month . '/' . $date->year;
        $username = "Lagobo.Distribuciones";
        $password = "Distribuciones2020";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://nzzpz5.api.infobip.com/sms/2/text/advanced",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n\t\"bulkId\":\"$code\",\r\n\t\"messages\":[\r\n\t\t{\r\n\t\t\t\"from\":\"InfoSMS\",\r\n\t\t\t\"destinations\":[\r\n\t\t\t\t{\r\n\t\t\t\t\t\"to\":\"57$celNumber\",\r\n\t\t\t\t\t\"messageId\":\"$code\"\r\n\t\t\t\t}\r\n\t\t\t],\r\n\t\t\t\"text\":\"$text\",\r\n\t\t\t\"flash\":false,\r\n\t\t\t\"intermediateReport\":false,\r\n\t\t\t\"validityPeriod\": 15\r\n\t\t}\r\n\t],\r\n\t\"tracking\":{\r\n\t\t\"track\":\"SMS\",\r\n\t\t\"type\":\"MY_CAMPAIGN\"\r\n\t}\r\n}",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic " . base64_encode($username . ":" . $password),
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }
}
