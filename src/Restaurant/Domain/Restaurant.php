<?php

namespace App\Restaurant\Domain;

use App\Core\Domain\AggregateRoot;
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
     * @ORM\OneToMany(targetEntity="App\Restaurant\Domain\Dish", mappedBy="restaurant")
     * @var Collection
     */
    private Collection $dishes;
}