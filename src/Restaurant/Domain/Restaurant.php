<?php

namespace App\Restaurant\Domain;

use App\Core\Domain\AggregateRoot;
use App\Restaurant\Domain\Collection\Menu;
use App\Restaurant\Domain\ValueObject\Dish\Price;
use App\Restaurant\Domain\ValueObject\Restaurant\Delivery;
use App\Restaurant\Domain\ValueObject\Restaurant\Name;
use App\Restaurant\Domain\ValueObject\Restaurant\RestaurantId;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="restaurants")
 */
class Restaurant extends AggregateRoot
{
    /**
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Restaurant\RestaurantId", columnPrefix=false)
     * @var RestaurantId
     */
    private RestaurantId $id;
    /**
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Restaurant\Name", columnPrefix=false)
     * @var Name
     */
    private Name $name;
    /**
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Restaurant\Delivery", columnPrefix="delivery_")
     * @var Delivery
     */
    private Delivery $delivery;
    /**
     * @ORM\OneToMany(targetEntity="App\Restaurant\Domain\Dish", mappedBy="restaurant", cascade={"persist", "remove"}, orphanRemoval=true)
     * @var Collection
     */
    private Collection $menu;

    public function __construct(Name $name, Delivery $delivery)
    {
        $this->id = new RestaurantId();
        $this->delivery = $delivery;
        $this->name = $name;
        $this->menu = new Menu();
    }

    public function id() : RestaurantId
    {
        return $this->id;
    }

    public function update(Name $name, Delivery $delivery) : void
    {
        $this->name = $name;
        $this->delivery = $delivery;
    }

    public function changeMenu(Menu $menu) : void
    {
        $this->menu = $menu;
    }

    public static function create(string $name, float $minDelivery, float $cost) : Restaurant
    {
        return new Restaurant(new Name($name), new Delivery(new Price($minDelivery), new Price($cost)));
    }
}