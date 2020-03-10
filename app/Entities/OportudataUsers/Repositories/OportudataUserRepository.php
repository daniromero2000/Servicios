<?php

namespace App\Entities\OportudataUsers\Repositories;

use App\Entities\OportudataUsers\OportudataUser;
use App\Entities\OportudataUsers\Repositories\Interfaces\OportudataUserRepositoryInterface;
use Illuminate\Database\QueryException;

class OportudataUserRepository implements OportudataUserRepositoryInterface
{
	public function __construct(
		OportudataUser $OportudataUser
	) {
		$this->model = $OportudataUser;
	}
}