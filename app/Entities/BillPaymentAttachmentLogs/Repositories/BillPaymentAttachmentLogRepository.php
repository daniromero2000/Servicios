<?php

namespace App\Entities\BillPaymentAttachmentLogs\Repositories;

use App\Entities\BillPaymentAttachmentLogs\BillPaymentAttachmentLog;
use App\Entities\BillPaymentAttachmentLogs\Exceptions\BillPaymentAttachmentLogNotFoundErrorException;
use App\Entities\BillPaymentAttachmentLogs\Exceptions\CreateBillPaymentAttachmentLogErrorException;
use Illuminate\Database\QueryException;

class BillPaymentAttachmentLogRepository implements BillPaymentAttachmentLogRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'bill_payment_id',
        'src',
        'user_id'
        // 'description'
    ];

    public function __construct(BillPaymentAttachmentLog $billPayment)
    {
        $this->model = $billPayment;
    }

    public function listBillPaymentAttachmentLogs($totalView)
    {
        return $this->model->orderBy('id', 'desc')
            ->skip($totalView)
            ->take(30)
            ->get($this->columns);
    }

    public function createBillPaymentAttachmentLog(array $data): BillPaymentAttachmentLog
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            // throw new CreateBillPaymentAttachmentLogErrorException($e);
        }
    }

    public function findBillPaymentAttachmentLogById(int $id): BillPaymentAttachmentLog
    {
        try {
            return $this->model->with('mailBillPaymentAttachmentLog')->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            // throw new BillPaymentAttachmentLogNotFoundErrorException($e);
        }
    }

    public function updateBillPaymentAttachmentLog(array $params): bool
    {
        try {
            $billPayment = $this->findBillPaymentAttachmentLogById($params['id']);
            
            return $billPayment->update($params['data']);
        } catch (QueryException $e) {
            // throw new UpdateCampaignErrorException($e);
        }
    }

    public function deleteNotificationById($id): bool
    {
        try {
            $data = $this->findBillPaymentAttachmentLogById($id);
            return $data->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
