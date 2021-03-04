<?php

namespace App\Restaurant\Domain;

use App\Core\Domain\AggregateRoot;
use App\Restaurant\Domain\Collection\Menu;
use App\Restaurant\Domain\ValueObject\Dish\Description;
use App\Restaurant\Domain\ValueObject\Dish\Picture;
use App\Restaurant\Domain\ValueObject\Dish\Price;
use App\Restaurant\Domain\ValueObject\Dish\Weight;
use App\Restaurant\Domain\ValueObject\Dish\Name as DishName;
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
    //I don't finished yet
    public function addDish(string $name, float $price, string $path, float $weight, string $description) : void
    {
        $this->menu->add(new Dish(new DishName($name), new Price($price), new Picture($path),
            new Weight($weight), new Description($description), $this));
    }

    public function update(Name $name, Delivery $delivery) : void
    {
        $this->name = $name;
        $this->delivery = $delivery;
    }
    //I don't finished yet
    private function removeDish(Menu $menu) : void
    {
        $this->menu->removeElement($menu);
    }

    public function getMenu() : Collection
    {
        return $this->menu;
    }

    public static function create(string $name, float $minDelivery, float $cost)
    {
        return new Restaurant(new Name($name), new Delivery(new Price($minDelivery), new Price($cost)));
    }

    //I don't finished yet
    public function changeMenu(Menu $menu)
    {
        $this->removeDish($menu);
       // $this->addDish();
    }
}