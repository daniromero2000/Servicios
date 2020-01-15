<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LeadStatusesTableSeeder::class);
        $this->call(ChannelTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(LeadProductTableSeeder::class);
        $this->call(LeadPriceStatusesTableSeeder::class);
    }
}
