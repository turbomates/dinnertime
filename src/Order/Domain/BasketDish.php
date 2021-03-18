<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\BasketDish\BasketDishId;
use App\Order\Domain\ValueObject\BasketDish\DishName;
use App\Order\Domain\ValueObject\BasketDish\DishPrice;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity()
 * @ORM\Table(name="basket_dish")
 */
class BasketDish
{
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\BasketDish\BasketDishId", columnPrefix=false)
     * @var BasketDishId
     */
    private BasketDishId $id;
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
    /**
     * @ORM\ManyToOne(targetEntity="App\Order\Domain\Basket", inversedBy="dishes")
     * @JoinColumn(name="basket_id", referencedColumnName="id", nullable=false)
     * @var Basket
     */
    private Basket $basket;

    public function __construct(DishName $dishName, DishPrice $dishPrice, Basket $basket)
    {
        $this->id = new BasketDishId();
        $this->dishName = $dishName;
        $this->dishPrice = $dishPrice;
        $this->basket = $basket;
    }
}