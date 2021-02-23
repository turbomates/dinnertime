<?php

namespace App\Restaurant\Domain;

use App\Restaurant\Domain\ValueObject\Dish\Description;
use App\Restaurant\Domain\ValueObject\Dish\DishId;
use App\Restaurant\Domain\ValueObject\Dish\Name;
use App\Restaurant\Domain\ValueObject\Dish\Picture;
use App\Restaurant\Domain\ValueObject\Dish\Price;
use App\Restaurant\Domain\ValueObject\Dish\Weight;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dishes")
 */
class Dish
{
    /**
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Dish\DishId", columnPrefix=false)
     * @var DishId
     */
    private DishId $id;
    /**
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Dish\Name", columnPrefix=false)
     * @var Name
     */
    private Name $name;
    /**
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Dish\Price", columnPrefix=false)
     * @var Price
     */
    private Price $price;
    /**
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Dish\Picture", columnPrefix=false)
     * @var Picture
     */
    private Picture $picture;
    /**
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Dish\Weight", columnPrefix=false)
     * @var Weight
     */
    private Weight $weight;
    /**
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Dish\Description", columnPrefix=false)
     * @var Description
     */
    private Description $description;
    /**
     * @ORM\ManyToOne(targetEntity="App\Restaurant\Domain\Restaurant", inversedBy="dishes")
     * @JoinColumn(name="restaurant_id", referencedColumnName="id", nullable=false)
     * @var Restaurant
     */
    private Restaurant $restaurant;
}