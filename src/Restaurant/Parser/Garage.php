<?php

namespace App\Restaurant\Parser;

use App\Restaurant\Domain\Collection\Menu;
use App\Restaurant\Domain\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;

class Garage implements Parser
{
    private const DISH_URL = 'https://garage.by/index.php?route=product/category&path=279_578';
    private const RESTAURANT_URL = 'https://garage.by/how-order';
    private const RESTAURANT_NAME = 'GARAGE';
    private RestaurantRepository $repository;
    private EntityManagerInterface $em;
    private UpsertRestaurant $restaurant;

    public function __construct(RestaurantRepository $repository, EntityManagerInterface $em, UpsertRestaurant $restaurant)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->restaurant = $restaurant;
    }

    private function menu() : Menu
    {
        $html = file_get_contents(self::DISH_URL);
        $crawler = new Crawler($html);
        $menu = new Menu();
        $crawler->filter('.product-wrappe')->each(function ($node, $i) use ($menu)
        {
            $name = $node->filter('h4')->text();
            $description = $node->filter('.decr')->text();
            $weight = preg_replace('/[^0-9]/', '', $node->filter('.weight')->text());
            $price = preg_replace('/[^0-9.]/', '', $node->filter('#price')->text());
            $image = $node->filter('.img-responsive')->image()->getUri();
            $menu->add(new Dish($name, $description, $weight, $price, $image));
        });

        return $menu;
    }

    private function delivery() : string
    {
        $html = file_get_contents(self::RESTAURANT_URL);
        $crawler = new Crawler($html);

        return substr(preg_replace('/[^0-9.]/', '', $crawler->filter('.row > .MsoNormal')->eq(2)->text()), 0,-1);
    }

    //I don't finished yet
    public function parse()
    {
        $restaurant = $this->restaurant->upsert(self::RESTAURANT_NAME, $this->delivery(), 0);
        $restaurant->changeMenu($this->menu());
        $this->repository->persist($restaurant);
        $this->em->flush();
    }



}