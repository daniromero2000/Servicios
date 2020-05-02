<?php

use App\Entities\Brands\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Brand::class)->create([
            'name' => 'Apple'
        ]);

        factory(Brand::class)->create([
            'name' => 'Samsung'
        ]);

        factory(Brand::class)->create([
            'name' => 'LG'
        ]);

        factory(Brand::class)->create([
            'name' => 'Sony'
        ]);

        factory(Brand::class)->create([
            'name' => 'AKT'
        ]);

        factory(Brand::class)->create([
            'name' => 'Mazda'
        ]);

        factory(Brand::class)->create([
            'name' => 'BMW'
        ]);

        factory(Brand::class)->create([
            'name' => 'Toyota'
        ]);

        factory(Brand::class)->create([
            'name' => 'Home Elements'
        ]);

        factory(Brand::class)->create([
            'name' => 'Auteco'
        ]);
    }
}
