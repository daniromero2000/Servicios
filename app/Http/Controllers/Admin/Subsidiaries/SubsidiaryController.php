<?php

namespace App\Http\Controllers\Admin\Subsidiaries;

use App\Http\Controllers\Controller;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;

class SubsidiaryController extends Controller
{
  private $subsidiaryinterface;

  public function __construct(
    SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
  ) {
    $this->subsidiaryinterface = $subsidiaryRepositoryInterface;
    $this->middleware('auth');
  }

  public function getSubsidiariesCity()
  {
    return response()->json($this->subsidiaryinterface->getAllSubsidiaryCityNames());
  }
}
