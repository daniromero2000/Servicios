<?php

use App\Entities\LeadProducts\LeadProduct;
use Illuminate\Database\Seeder;

class LeadProductTableSeeder extends Seeder
{
    public function run()
    {
        factory(LeadProduct::class)->create([
            'lead_product'  => 'Televisor',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Sonido',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Nevera',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Nevecon',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Lavadora',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Celular',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Ventilador',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Congelador',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Estufa',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Colchón',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Portátil',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Computador',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Freidora de aire',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Impresora',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Caldero',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Barra de sonido',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Parlante',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Batería',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Licuadora',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Plancha',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Plancha alisadora',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Olla a presión',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Sanduchera',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Horno Microndas',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Aire acondicionado',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Moto',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'SOAT',
        ]);

        factory(LeadProduct::class)->create([
            'lead_product'  => 'Libranza',
        ]);
    }
}
