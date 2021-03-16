<?php

namespace App\Restaurant\Domain;

use App\Restaurant\Domain\ValueObject\Restaurant\Name;

interface RestaurantRepository
{
    public function findByName(Name $name) : ?Restaurant;

    public function add(Restaurant $restaurant) : void;
}