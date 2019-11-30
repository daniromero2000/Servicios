<?php

namespace App\Entities\Customers\Repositories;

use App\Entities\Customers\Customer;
use App\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class CustomerRepository implements CustomerRepositoryInterface
{
    private $columns = [
        'CEDULA',
        'APELLIDOS',
        'NOMBRES',
        'TIPOCLIENTE',
        'SUBTIPO',
        'ORIGEN',
        'PASO',
        'ESTADO',
    ];


    public function __construct(
        Customer $customer
    ) {
        $this->model = $customer;
    }

    // public function listCustomers()
    // {
    //     return $this->model->with([
    //         'creditCard',
    //         'latestIntention'
    //     ])->limit(30)->get();
    // }

    public function updateOrCreateCustomer($data)
    {
        try {
            return $this->model->updateOrCreate(['CEDULA' => $data['CEDULA']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function listCustomersDigitalChannel()
    {
        return $this->model->with([
            'creditCard',
            'factoryRequests'
        ])->where('ESTADO', 'APROBADO')
            ->has('hasFactoryRequests')
            ->get(['NOMBRES', 'APELLIDOS', 'CELULAR', 'CIUD_UBI', 'CEDULA', 'CREACION']);
    }

    public function findCustomerById($identificationNumber): Customer
    {
        try {
            return $this->model->with([
                'latestCifinScore',
                'latestIntention'
            ])->findOrFail($identificationNumber);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function checkIfExists($identificationNumber)
    {
        try {
            return $this->model->where('CEDULA', $identificationNumber)->get(['CLIENTE_WEB', 'USUARIO_CREACION'])->first();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCustomers($totalView): Support
    {
        try {
            return  $this->model->with([])
                ->orderBy('CREACION', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countCustomersCreditProfiles($from, $to)
    {
        try {
            return  $this->model->select('PERFIL_CREDITICIO', DB::raw('count(*) as total'))
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('PERFIL_CREDITICIO')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function countCustomersCreditCards($from, $to)
    {
        try {
            return  $this->model->select('TARJETA', DB::raw('count(*) as total'))
                ->whereBetween('FECHA_INTENCION', [$from, $to])
                ->groupBy('TARJETA')
                ->get();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchCustomers(string $text = null, $totalView,  $from = null,  $to = null,  $creditprofile = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to) && is_null($creditprofile)) {
            return $this->model->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        }

        if (is_null($from) || is_null($to)) {
            return $this->model->searchCustomers($text, null, true, true)->with(['customer', 'definition'])
                ->when($creditprofile, function ($q, $creditprofile) {
                    return $q->where('PERFIL_CREDITICIO', $creditprofile);
                })
                ->orderBy('FECHA_INTENCION', 'desc')
                ->skip($totalView)
                ->take(100)
                ->get($this->columns);
        }

        return $this->model->searchCustomers($text, null, true, true)->with(['customer', 'definition'])
            ->whereBetween('FECHA_INTENCION', [$from, $to])
            ->when($creditprofile, function ($q, $creditprofile) {
                return $q->where('PERFIL_CREDITICIO', $creditprofile);
            })
            ->orderBy('FECHA_INTENCION', 'desc')
            ->get($this->columns);
    }
}
