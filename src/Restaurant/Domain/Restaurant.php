<?php

namespace App\Restaurant\Domain;

use App\Core\Domain\AggregateRoot;
use App\Restaurant\Domain\Collection\Menu;
use App\Restaurant\Domain\ValueObject\Dish\Price;
use App\Restaurant\Domain\ValueObject\Restaurant\Delivery;
use App\Restaurant\Domain\ValueObject\Restaurant\Name;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="restaurants")
 */
class Restaurant extends AggregateRoot
{
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
     * @ORM\OneToMany(targetEntity="App\Restaurant\Domain\Dish", mappedBy="restaurant", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     * @var Collection
     */
    private Collection $menu;

    public function __construct(Name $name)
    {
        $this->delivery = new Delivery(new Price(0), new Price(0));
        $this->name = $name;
        $this->menu = new Menu();
    }

    public function update(Name $name): void
    {
        $this->name = $name;
    }

    public function changeMenu(Menu $menu): void
    {
        $this->menu = $menu;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function menu() : Menu
    {
        return $this->menu;
    }

    public function updateDelivery(Delivery $delivery) : void
    {
        $this->delivery = $delivery;
    }

    public static function create(Name $name) : Restaurant
    {
        return new Restaurant($name);
    }
}