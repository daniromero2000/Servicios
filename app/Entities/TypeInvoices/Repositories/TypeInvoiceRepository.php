<?php

namespace App\Entities\TypeInvoices\Repositories;

use App\Entities\TypeInvoices\TypeInvoice;
use App\Entities\TypeInvoices\Exceptions\TypeInvoiceNotFoundErrorException;
use App\Entities\TypeInvoices\Exceptions\CreateTypeInvoiceErrorException;
use Illuminate\Database\QueryException;

class TypeInvoiceRepository implements TypeInvoiceRepositoryInterface
{
   protected $model;
    private $columns = [
        'name',
        'status'
    ];

    public function __construct(TypeInvoice $billPayment)
    {
        $this->model = $billPayment;
    }

    public function listTypeInvoices($id): array
    {
        $billPaymentList = $this->model->get($this->columns);

        return (empty($billPaymentList)) ? [] : $billPaymentList->toArray();
    }


    public function listAllTypeInvoices()
    {
      return $this->model->where('status', '1')->orderBy('name', 'ASC')->get();
    }

    public function createTypeInvoice(array $data): TypeInvoice
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            // throw new ($e);
        }
    }

    public function searchTypeInvoice(string $text = null, int $totalView, $from = null, $to = null): array
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listTypeInvoices($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                $billPaymentList = $this->model->searchTypeInvoice($text, null, true, true)
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

            $billPaymentList = $this->model->searchTypeInvoice($text, null, true, true)
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

    public function countTypeInvoices(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchTypeInvoice($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchTypeInvoice($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function findTypeInvoiceById(int $id): TypeInvoice
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            // throw new TypeInvoiceNotFoundErrorException($e);
        }
    }

    public function deleteNotificationById($id): bool
    {
        try {
            $data = $this->findTypeInvoiceById($id);
            return $data->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

}
