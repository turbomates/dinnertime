<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\BasketDish\BasketDishId;
use App\Order\Domain\ValueObject\BasketDish\DishId;
use App\Order\Domain\ValueObject\BasketDish\DishName;
use App\Order\Domain\ValueObject\Price;
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
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Price", columnPrefix=false)
     * @var Price
     */
    private Price $dishPrice;
    /**
     * @ORM\ManyToOne(targetEntity="App\Order\Domain\Basket", inversedBy="dishes")
     * @JoinColumn(name="basket_id", referencedColumnName="id", nullable=false)
     * @var Basket
     */
    private Basket $basket;

    public function __construct(DishId $dishId, DishName $dishName, Price $dishPrice, Basket $basket)
    {
        $this->id = new BasketDishId();
        //Think to remove
        $this->dishId = $dishId;
        $this->dishName = $dishName;
        $this->dishPrice = $dishPrice;
        $this->basket = $basket;
    }

    public function id() : BasketDishId
    {
        return $this->id;
    }
}