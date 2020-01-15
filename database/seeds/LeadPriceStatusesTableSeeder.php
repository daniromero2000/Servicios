<?php

use App\Entities\LeadPriceStatus\LeadPriceStatus;
use Illuminate\Database\Seeder;

class LeadPriceStatusesTableSeeder extends Seeder
{
    public function run()
    {
        factory(LeadPriceStatus::class)->create([
            'status'  => 'Vendido',
            'color'  => 'success'
        ]);

        factory(LeadPriceStatus::class)->create([
            'status'  => 'Desistido',
            'color'  => 'danger'
        ]);

        factory(LeadPriceStatus::class)->create([
            'status'  => 'Cotizado',
            'color'  => 'warning'
        ]);
    }
}
