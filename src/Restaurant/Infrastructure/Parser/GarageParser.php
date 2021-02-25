<?php

namespace App\Restaurant\Infrastructure\Parser;

use Symfony\Component\DomCrawler\Crawler;

class GarageParser
{
    public function parser()
    {
        $url = 'https://garage.by/index.php?route=product/category&path=279_578';
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        $crawler->filter('.product-wrappe')->each(function ($node, $i){
            $name = $node->filter('h4')->text();
            $description = $node->filter('.decr')->text();
            $weight = $node->filter('.weight')->text();
            $price = substr($node->filter('#price')->text(), 0, -4);
            $image = $node->filter('.img-responsive')->image()->getUri();
        });
    }
}