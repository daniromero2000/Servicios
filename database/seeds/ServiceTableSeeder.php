<?php

use App\Entities\Services\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    public function run()
    {
        factory(Service::class)->create([
            'service'  => 'Contado',
        ]);

        factory(Service::class)->create([
            'service'  => 'Crédito',
        ]);

        factory(Service::class)->create([
            'service'  => 'Motos',
        ]);

        factory(Service::class)->create([
            'service'  => 'Seguros',
        ]);

        factory(Service::class)->create([
            'service'  => 'Garantía Digital',
        ]);
    }
}
