<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use App\Entities\leads\Repositories\leadRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            LeadRepositoryInterface::class,
            leadRepository::class
        );
    }
}
