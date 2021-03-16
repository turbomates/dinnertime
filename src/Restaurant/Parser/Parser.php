<?php

namespace App\Restaurant\Parser;

use App\Restaurant\Domain\Restaurant;

interface Parser
{
    public function getRestaurant() : Restaurant;
}