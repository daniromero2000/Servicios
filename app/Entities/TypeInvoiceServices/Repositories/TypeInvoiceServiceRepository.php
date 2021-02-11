<?php

namespace App\Entities\TypeInvoiceServices\Repositories;

use App\Entities\TypeInvoiceServices\TypeInvoiceService;
use App\Entities\TypeInvoiceServices\Exceptions\TypeInvoiceServiceNotFoundErrorException;
use App\Entities\TypeInvoiceServices\Exceptions\CreateTypeInvoiceServiceErrorException;
use Illuminate\Database\QueryException;

class TypeInvoiceServiceRepository implements TypeInvoiceServiceRepositoryInterface
{
   protected $model;
    private $columns = [
        'name',
        'status'
    ];

    public function __construct(TypeInvoiceService $billPayment)
    {
        $this->model = $billPayment;
    }

    public function listTypeInvoiceServices($id): array
    {
        $billPaymentList = $this->model->get($this->columns);

        return (empty($billPaymentList)) ? [] : $billPaymentList->toArray();
    }


    public function listAllTypeInvoiceServices()
    {
      return $this->model->where('status', '1')->get();
    }

    public function createTypeInvoiceService(array $data): TypeInvoiceService
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            // throw new ($e);
        }
    }

    public function searchTypeInvoiceService(string $text = null, int $totalView, $from = null, $to = null): array
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listTypeInvoiceServices($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                $billPaymentList = $this->model->searchTypeInvoiceService($text, null, true, true)
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

            $billPaymentList = $this->model->searchTypeInvoiceService($text, null, true, true)
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

    public function countTypeInvoiceServices(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchTypeInvoiceService($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchTypeInvoiceService($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function findTypeInvoiceServiceById(int $id): TypeInvoiceService
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            // throw new TypeInvoiceServiceNotFoundErrorException($e);
        }
    }

    public function deleteNotificationById($id): bool
    {
        try {
            $data = $this->findTypeInvoiceServiceById($id);
            return $data->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

}
