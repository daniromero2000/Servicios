<?php

namespace App\Entities\TelephoneBillPayments\Repositories;

use App\Entities\TelephoneBillPayments\TelephoneBillPayment;
use Illuminate\Database\QueryException;

class TelephoneBillPaymentRepository implements TelephoneBillPaymentRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'bill_payment_id',
        'telephone'
    ];

    public function __construct(TelephoneBillPayment $billPayment)
    {
        $this->model = $billPayment;
    }

    public function listTelephoneBillPayments($totalView)
    {
        return $this->model->orderBy('id', 'desc')
            ->skip($totalView)
            ->take(30)
            ->get($this->columns);
    }

    public function createTelephoneBillPayment(array $data): TelephoneBillPayment
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            // throw new CreateTelephoneBillPaymentErrorException($e);
        }
    }

    public function destroyTelephoneBillPaymen($id): bool
    {
        try {
            return $this->model->where('bill_payment_id', $id)->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchTelephoneBillPayment(string $text = null, int $totalView, $from = null, $to = null)
    {
        try {

            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listTelephoneBillPayments($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchTelephoneBillPayment($text, null, true, true)
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

            return $this->model->searchTelephoneBillPayment($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countTelephoneBillPayments(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchTelephoneBillPayment($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchTelephoneBillPayment($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function findTelephoneBillPaymentById(int $id): TelephoneBillPayment
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            // throw new TelephoneBillPaymentNotFoundErrorException($e);
        }
    }

    public function deleteNotificationById($id): bool
    {
        try {
            $data = $this->findTelephoneBillPaymentById($id);
            return $data->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
