<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\Basket\BasketId;
use App\Order\Domain\ValueObject\BasketDish\DishId;
use App\Order\Domain\ValueObject\BasketDish\DishName;
use App\Order\Domain\ValueObject\BasketDish\DishPrice;
use Doctrine\ORM\Mapping as ORM;

//I think about connection many to many

/**
 * @ORM\Entity()
 * @ORM\Table(name="basket_dish")
 */
class BasketDish
{
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Basket\BasketId", columnPrefix=false)
     * @var BasketId
     */
    private BasketId $basketId;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\BasketDish\DishId", columnPrefix=false)
     * @var DishId
     */
    private DishId $dishId;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\BasketDish\DishName", columnPrefix=false)
     * @var DishName
     */
    private DishName $dishName;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\BasketDish\DishPrice", columnPrefix=false)
     * @var DishPrice
     */
    private DishPrice $dishPrice;
}