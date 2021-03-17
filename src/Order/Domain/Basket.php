<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\Basket\BasketId;
use App\Order\Domain\ValueObject\Basket\CreatedAt;
use App\Order\Domain\ValueObject\Basket\UserId;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="basket")
 */
class Basket
{
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Basket\BasketId", columnPrefix=false)
     * @var BasketId
     */
    private BasketId $id;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Basket\CreatedAt", columnPrefix=false)
     * @var CreatedAt
     */
    private CreatedAt $createdAt;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Basket\UserId", columnPrefix=false)
     * @var UserId
     */
    private UserId $userId;
    /**
     * @ORM\OneToMany(targetEntity="App\Order\Domain\BasketDish", mappedBy="basket", cascade={"persist", "remove"}, orphanRemoval=true)
     * @var Collection
     */
    private Collection $dishes;

}