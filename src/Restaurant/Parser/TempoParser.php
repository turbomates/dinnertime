<?php

namespace App\Restaurant\Parser;

use Symfony\Component\DomCrawler\Crawler;

class TempoParser implements ParserInterface
{
    public function dish()
    {
        $url = 'https://www.pizzatempo.by/menu/obed.html';
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        $crawler->filter('.item_product')->each(function (Crawler $node, $i) {
            $name = $node->filter('h3')->text();
            $description = $node->filter('.composition')->text();
            $weight = $node->filter('.size')->text();
            $price = str_replace('р', '', substr($node->filter('.price_wrapper')
                          ->siblings()->text(), 0, -3));
            $image = $node->filter('img')->image()->getUri();
        });
    }

    public function parse()
    {
        $url = 'https://www.pizzatempo.by/menu/obed.html';
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        $crawler->filter('.item_product')->each(function (Crawler $node, $i) {
            $name = $node->filter('h3')->text();
            $description = $node->filter('.composition')->text();
            $weight = $node->filter('.size')->text();
            $price = str_replace('р', '', substr($node->filter('.price_wrapper')
                ->siblings()->text(), 0, -3));
            $image = $node->filter('img')->image()->getUri();
        });
    }
}