<?php

namespace App\Entities\MailsBillPayments\Repositories;

use App\Entities\MailsBillPayments\MailsBillPayment;
use App\Entities\MailsBillPayments\Exceptions\MailsBillPaymentNotFoundErrorException;
use App\Entities\MailsBillPayments\Exceptions\CreateMailsBillPaymentErrorException;
use Illuminate\Database\QueryException;

class MailsBillPaymentRepository implements MailsBillPaymentRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'bill_payment_id',
        'email'
    ];

    public function __construct(MailsBillPayment $billPayment)
    {
        $this->model = $billPayment;
    }

    public function listMailsBillPayments($totalView)
    {
        return $this->model->orderBy('id', 'desc')
            ->skip($totalView)
            ->take(30)
            ->get($this->columns);
    }

    public function createMailsBillPayment(array $data): MailsBillPayment
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateMailsBillPaymentErrorException($e);
        }
    }

    public function destroyMailsBillPaymen($id): bool
    {
        try {
            return $this->model->where('bill_payment_id', $id)->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchMailsBillPayment(string $text = null, int $totalView, $from = null, $to = null)
    {
        try {

            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listMailsBillPayments($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchMailsBillPayment($text, null, true, true)
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

            return $this->model->searchMailsBillPayment($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countMailsBillPayments(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchMailsBillPayment($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchMailsBillPayment($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function findMailsBillPaymentById(int $id): MailsBillPayment
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            throw new MailsBillPaymentNotFoundErrorException($e);
        }
    }

    public function deleteNotificationById($id): bool
    {
        try {
            $data = $this->findMailsBillPaymentById($id);
            return $data->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
