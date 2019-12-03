<?php

use App\Entities\Channels\Channel;
use Illuminate\Database\Seeder;

class ChannelTableSeeder extends Seeder
{
    public function run()
    {
        factory(Channel::class)->create([
            'channel'  => 'Pagina Web',
        ]);

        factory(Channel::class)->create([
            'channel'  => 'Whatsapp',
        ]);

        factory(Channel::class)->create([
            'channel'  => 'Facebook',
        ]);
    }
}
