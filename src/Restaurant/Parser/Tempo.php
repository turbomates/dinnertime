<?php

namespace App\Restaurant\Parser;

use App\Restaurant\Domain\Collection\Menu;
use App\Restaurant\Domain\Dish;
use App\Restaurant\Domain\Restaurant;
use App\Restaurant\Domain\ValueObject\Dish\Description;
use App\Restaurant\Domain\ValueObject\Dish\Name;
use App\Restaurant\Domain\ValueObject\Restaurant\Delivery;
use App\Restaurant\Domain\ValueObject\Restaurant\Name as RestaurantName;
use App\Restaurant\Domain\ValueObject\Dish\Picture;
use App\Restaurant\Domain\ValueObject\Dish\Price;
use App\Restaurant\Domain\ValueObject\Dish\Weight;
use Symfony\Component\DomCrawler\Crawler;

class Tempo implements Parser
{
    private const DISH_URL = 'https://www.pizzatempo.by/menu/obed.html';
    private const RESTAURANT_NAME = 'tempo';
    private const MIN_DELIVERY = 0;
    private const COST = 0;

    public function menu(Restaurant $restaurant) : Menu
    {
        $html = file_get_contents(self::DISH_URL);
        $crawler = new Crawler($html);
        $menu = new Menu();
        $crawler->filter('.item_product')->each(function ($node, $i) use ($menu, $restaurant)
        {
            $name = $node->filter('h3')->text();
            $description = $node->filter('.composition')->text();
            $weight = preg_replace('/[^0-9.]/', '', $node->filter('.size')->text());
            $price = substr(preg_replace('/[^0-9.]/', '', $node->filter('.price_wrapper')->text()), 0, -1);
            $image = $node->filter('img')->image()->getUri();
            $menu->add(new Dish(new Name($name), new Price($price), new Picture($image), new Weight($weight), new Description($description), $restaurant));
        });

        return $menu;
    }

    public function getRestaurant() : Restaurant
    {
        $restaurant = Restaurant::create(new RestaurantName(self::RESTAURANT_NAME));
        $restaurant->changeMenu($this->menu($restaurant));
        $restaurant->updateDelivery(new Delivery(new Price(self::MIN_DELIVERY), new Price(self::COST)));

        return $restaurant;
    }
}