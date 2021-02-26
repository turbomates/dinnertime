<?php

namespace App\Restaurant\Parser;

class Dish
{
    public string $dishName;
    public string $description;
    public string $weight;
    public string $price;
    public string $image;

    public function __construct(string $dishName, string $description, string $weight, string $price, string $image)
    {
        $this->dishName = $dishName;
        $this->description = $description;
        $this->weight = $weight;
        $this->price = $price;
        $this->image = $image;
    }
}