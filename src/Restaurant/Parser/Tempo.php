<?php

namespace App\Restaurant\Parser;

use App\Restaurant\Parser\Collection\MenuCollection;
use Symfony\Component\DomCrawler\Crawler;

class Tempo implements Parser
{
    private const DISH_URL = 'https://www.pizzatempo.by/menu/obed.html';

    public function dish() : MenuCollection
    {
        $html = file_get_contents(self::DISH_URL);
        $crawler = new Crawler($html);
        $crawler->filter('.item_product')->each(function (Crawler $node, $i) {
            $name = $node->filter('h3')->text();
            $description = $node->filter('.composition')->text();
            $weight = preg_replace('/[^0-9.]/', '', $node->filter('.size')->text());
            $price = substr(preg_replace('/[^0-9.]/', '', $node->filter('.price_wrapper')->text()), 0, -1);
            $image = $node->filter('img')->image()->getUri();
        });
    }

    public function parse() : CreateRestaurant
    {

    }
}