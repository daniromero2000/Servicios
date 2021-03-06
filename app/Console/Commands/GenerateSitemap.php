<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Psr\Http\Message\UriInterface;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // modify this to your own needs
        SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) {
             if (($url->segment(1) === 'seguros') || ($url->segment(1) === 'motos')){
               return;
             }

            return $url;
            })
            ->getSitemap()
            ->writeToFile(public_path('sitemap.xml'));
    }
}
