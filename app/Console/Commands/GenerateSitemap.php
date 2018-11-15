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
            ->shouldCrawl(function (UriInterface $url) {

                $avoidUrls=['/viajes','/seguros','/motos'];
                $i=0;
                for($i;$i<count($avoidUrls); $i++){
                    return strpos($url->getPath(), $avoidUrls[$i])==false;
                    
                }
            })
            ->getSitemap()
            ->writeToFile(public_path('sitemap.xml'));
    }
}
