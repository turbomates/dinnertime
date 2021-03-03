<?php

namespace App\Restaurant\Parser;

interface Parser
{
    public function parse(): CreateRestaurant;
}