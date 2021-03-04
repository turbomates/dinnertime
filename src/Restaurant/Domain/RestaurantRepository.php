<?php

namespace App\Restaurant\Domain;

use App\Restaurant\Domain\ValueObject\Restaurant\Name;

interface RestaurantRepository
{
    public function persist(Restaurant $restaurant) : void;

    public function findByName(Name $name) : ?Restaurant;
}