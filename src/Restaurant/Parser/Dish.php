<?php

namespace App\Restaurant\Parser;

class Dish
{
    public string $dishName;
    public string $description;
    public int $weight;
    public float $price;
    public string $image;

    public function __construct(string $dishName, string $description, int $weight, float $price, string $image)
    {
        $this->dishName = $dishName;
        $this->description = $description;
        $this->weight = $weight;
        $this->price = $price;
        $this->image = $image;
    }
}