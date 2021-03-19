<?php

namespace App\Order\Domain;

use App\Core\Domain\AggregateRoot;
use App\Order\Domain\Collection\Dishes;
use App\Order\Domain\ValueObject\Basket\BasketId;
use App\Order\Domain\ValueObject\CreatedAt;
use App\Order\Domain\ValueObject\Basket\UserId;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="basket")
 */
class Basket extends AggregateRoot
{
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Basket\BasketId", columnPrefix=false)
     * @var BasketId
     */
    private BasketId $id;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\CreatedAt", columnPrefix=false)
     * @var CreatedAt
     */
    private CreatedAt $createdAt;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Basket\UserId", columnPrefix=false)
     * @var UserId
     */
    private UserId $userId;
    /**
     * @ORM\OneToMany(targetEntity="App\Order\Domain\BasketDish", mappedBy="basket", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     * @var Collection
     */
    private Collection $dishes;

    public function __construct(UserId $userId)
    {
        $this->id = new BasketId();
        $this->createdAt = new CreatedAt();
        $this->userId = $userId;
        $this->dishes = new Dishes();
    }

    public function addDish(BasketDish $dish) : void
    {
        $this->dishes->add($dish);
    }

    public static function create(UserId $userId) : Basket
    {
        return new Basket($userId);
    }
}