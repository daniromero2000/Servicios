<?php

namespace App\Entities\Tools\Repositories;

use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

class ToolRepository implements ToolRepositoryInterface
{

  public function getSkip($RequestSkip)
  {
    if ($RequestSkip == null) {
      return 0;
    } else {
      return $RequestSkip;
    }
  }
}
