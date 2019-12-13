<?php

namespace App\Entities\Tools\Repositories\Interfaces;


interface ToolRepositoryInterface
{
  public function getSkip($RequestSkip);

  public function getDataPercentage($data);

  public function extractValuesToArray($data);
}
