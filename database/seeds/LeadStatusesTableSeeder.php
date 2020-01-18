<?php

use App\Entities\LeadStatuses\LeadStatus;
use Illuminate\Database\Seeder;

class LeadStatusesTableSeeder extends Seeder
{
    public function run()
    {

        factory(LeadStatus::class)->create([
            'status'  => 'Contactado',
            'color' => 'blue'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Vendido',
            'color' => 'green'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Asignado a:',
            'color' => 'yellow'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Impactado',
            'color' => 'blue'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Desistido',
            'color' => 'purple'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Negado',
            'color' => 'red'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Cotizado',
            'color' => 'pink'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'En Gestión',
            'color' => 'marron'
        ]);

        factory(LeadStatus::class)->create([
            'status'  => 'Cerrado',
            'color' => 'red'
        ]);
    }
}