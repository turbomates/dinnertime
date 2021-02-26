<?php

namespace App\Restaurant\Parser;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;

class GarageParser implements ParserInterface
{
    private ArrayCollection $dishes;

    public function __construct()
    {
        $this->dishes = new ArrayCollection();
    }

    public function dish() : void
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

    public function delivery() : string
    {
        $url = 'https://garage.by/how-order';
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        $minDelivery = substr($crawler->filter('.row > .MsoNormal')->eq(2)->text(), -13, -8);

        return $minDelivery;
    }

    public function restaurantName() : string
    {
        $url = 'https://garage.by/how-order';
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        $restaurantName = substr($crawler->filter('.MsoNormal')->eq(0)->text(), 28, -64);

        return $restaurantName;
    }

    public function parse() : Restaurant
    {
        $url = 'https://garage.by/menu/domashnjajaeda1130-2300/';
        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        $crawler->filter('.product-wrappe')->each(function ($node, $i){
            $name = $node->filter('h4')->text();
            $description = $node->filter('.decr')->text();
            $weight = $node->filter('.weight')->text();
            $price = substr($node->filter('#price')->text(), 0, -4);
            $image = $node->filter('.img-responsive')->image()->getUri();
            $this->dishes->add(new Dish($name, $description, $weight, $price, $image));
        });

       return new Restaurant($this->restaurantName(), $this->delivery(), 0, $this->dishes);
    }
}