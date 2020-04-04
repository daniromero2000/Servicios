<?php

namespace App\Entities\UbicaAddresses\Repositories;

use App\Entities\UbicaAddresses\Repositories\Interfaces\UbicaAddressRepositoryInterface;
use App\Entities\UbicaAddresses\UbicaAddress;
use Illuminate\Database\QueryException;

class UbicaAddressRepository implements UbicaAddressRepositoryInterface
{
	public function __construct(
		UbicaAddress $ubicaAddress
	) {
		$this->model = $ubicaAddress;
	}


	public function getAddresses($customerAddresses){
		try {
			return  $this->model->whereNotIn('ubidireccion',$customerAddresses)->groupBy('ubidireccion')->orderByRaw("RAND()")->limit(4)->get(['ubidireccion']);
		} catch (QueryException $e) {
			dd($e);
			//throw $th;
		}
	}
}
