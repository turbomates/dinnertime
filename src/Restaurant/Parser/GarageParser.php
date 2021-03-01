<?php

namespace App\Restaurant\Parser;

use App\Restaurant\Parser\Collection\DishCollection;
use Symfony\Component\DomCrawler\Crawler;

class GarageParser implements ParserInterface
{
    private const DISH_URL = 'https://garage.by/index.php?route=product/category&path=279_578';
    private const RESTAURANT_URL = 'https://garage.by/how-order';
    private const RESTAURANT_NAME = 'GARAGE';

    public function __construct()
    {

    }

    private function dish() : DishCollection
    {
        $html = file_get_contents(self::DISH_URL);
        $crawler = new Crawler($html);
        $dishes= new DishCollection();
        $crawler->filter('.product-wrappe')->each(function ($node, $i) use ($dishes)
        {
            $name = $node->filter('h4')->text();
            $description = $node->filter('.decr')->text();
            $weight = preg_replace('/[^0-9]/', '', $node->filter('.weight')->text());
            $price = preg_replace('/[^0-9.]/', '', $node->filter('#price')->text());
            $image = $node->filter('.img-responsive')->image()->getUri();
            $dishes->add(new Menu($name, $description, $weight, $price, $image));
        });

        return $dishes;
    }

    private function delivery() : string
    {
        $html = file_get_contents(self::RESTAURANT_URL);
        $crawler = new Crawler($html);
        $minDelivery = substr(preg_replace('/[^0-9.]/', '', $crawler->filter('.row > .MsoNormal')->eq(2)->text()), 0,-1);

        return $minDelivery;
    }

    public function parse() : CreateRestaurant
    {
       return new CreateRestaurant (self::RESTAURANT_NAME, $this->delivery(), 0, $this->dish());
    }
}