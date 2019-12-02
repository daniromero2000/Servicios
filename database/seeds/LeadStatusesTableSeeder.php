<?php

use App\Entities\LeadStatuses\LeadStatus;
use Illuminate\Database\Seeder;

class LeadStatusesTableSeeder extends Seeder
{
    public function run()
    {
        factory(LeadStatus::class)->create([
            'status'  => 'Contactado',
            'color' => 'green'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Vendido',
            'color' => 'yellow'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Asignado a:',
            'color' => 'red'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Impactado',
            'color' => 'blue'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Desistido',
            'color' => 'grey'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Negado',
            'color' => 'orange'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Cotizado',
            'color' => 'orange'
        ]);
    }
}
