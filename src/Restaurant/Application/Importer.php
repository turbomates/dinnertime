<?php

namespace App\Restaurant\Application;

use App\Restaurant\Domain\RestaurantRepository;
use App\Restaurant\Parser\Parser;

class Importer
{
    private iterable $importers;
    private RestaurantRepository $repository;

    public function __construct(iterable $importers, RestaurantRepository $repository)
    {
        $this->importers = $importers;
        $this->repository = $repository;
    }

    public function import() : void
    {
        /** @var Parser $importer */
        foreach ($this->importers as $importer){
            $restaurant = $importer->getRestaurant();
            $this->repository->add($restaurant);
        }
    }
}