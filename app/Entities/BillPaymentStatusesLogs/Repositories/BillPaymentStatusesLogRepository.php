<?php

namespace App\Entities\BillPaymentStatusesLogs\Repositories;

use App\Entities\BillPaymentStatusesLogs\BillPaymentStatusesLog;
use App\Entities\BillPaymentStatusesLogs\Exceptions\BillPaymentStatusesLogNotFoundErrorException;
use App\Entities\BillPaymentStatusesLogs\Exceptions\CreateBillPaymentStatusesLogErrorException;
use Illuminate\Database\QueryException;

class BillPaymentStatusesLogRepository implements BillPaymentStatusesLogRepositoryInterface
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
        // 'description'
    ];

    public function __construct(BillPaymentStatusesLog $billPayment)
    {
        $this->model = $billPayment;
    }

    public function listBillPaymentStatusesLogs($totalView)
    {
        return $this->model->orderBy('id', 'desc')
            ->skip($totalView)
            ->take(30)
            ->get($this->columns);
    }

    public function createBillPaymentStatusesLog(array $data): BillPaymentStatusesLog
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            // throw new CreateBillPaymentStatusesLogErrorException($e);
        }
    }

    public function findBillPaymentStatusesLogById(int $id): BillPaymentStatusesLog
    {
        try {
            return $this->model->with('mailBillPaymentStatusesLog')->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            // throw new BillPaymentStatusesLogNotFoundErrorException($e);
        }
    }

    public function updateBillPaymentStatusesLog(array $params): bool
    {
        try {
            $billPayment = $this->findBillPaymentStatusesLogById($params['id']);
            
            return $billPayment->update($params['data']);
        } catch (QueryException $e) {
            // throw new UpdateCampaignErrorException($e);
        }
    }

    public function deleteNotificationById($id): bool
    {
        try {
            $data = $this->findBillPaymentStatusesLogById($id);
            return $data->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
