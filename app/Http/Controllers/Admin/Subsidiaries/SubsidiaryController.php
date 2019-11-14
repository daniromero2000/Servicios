<?php

namespace App\Http\Controllers\Admin\Subsidiary;

use App\Http\Controllers\Controller;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;

class SubsidiaryController extends Controller
{
  private $subsidiaryinterface;

  public function __construct(
    SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
  ) {
    $this->subsidiaryinterface = $subsidiaryRepositoryInterface;
    $this->middleware('auth:admin');
  }

  public function getSubsidiariesCity()
  {
    return response()->json($this->subsidiaryinterface->getSubsidiariesCity());
  }
}
