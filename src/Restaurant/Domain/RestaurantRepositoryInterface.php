<?php

namespace App\Restaurant\Domain;

interface RestaurantRepositoryInterface
{
    public function persist(Restaurant $restaurant);
}