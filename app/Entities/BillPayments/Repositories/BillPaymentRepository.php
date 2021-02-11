<?php

namespace App\Entities\BillPayments\Repositories;

use App\Entities\BillPayments\BillPayment;
use App\Entities\BillPayments\Exceptions\BillPaymentNotFoundErrorException;
use App\Entities\BillPayments\Exceptions\CreateBillPaymentErrorException;
use Illuminate\Database\QueryException;

class BillPaymentRepository implements BillPaymentRepositoryInterface
{
   protected $model;
    private $columns = [
        'id',
        'address',
        'deadline',
        'status',
        'subsidiary_id',
        'type_of_invoice',
        'contract_number'
    ];

    public function __construct(BillPayment $billPayment)
    {
        $this->model = $billPayment;
    }

    public function listBillPayments($id)
    {
        return $this->model->get($this->columns);
    }

    public function createBillPayment(array $data): BillPayment
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateBillPaymentErrorException($e);
        }
    }

    public function searchBillPayment(string $text = null, int $totalView, $from = null, $to = null): array
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listBillPayments($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                $billPaymentList = $this->model->searchBillPayment($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
                return (empty($billPaymentList)) ? [] : $billPaymentList->toArray();
            }

            if (empty($text) && (!is_null($from) || !is_null($to))) {
                $billPaymentList = $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
                return (empty($billPaymentList)) ? [] : $billPaymentList->toArray();
            }

            $billPaymentList = $this->model->searchBillPayment($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
            return (empty($billPaymentList)) ? [] : $billPaymentList->toArray();
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
            return $this->model->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            throw new BillPaymentNotFoundErrorException($e);
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

}