<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\Order\OrderId;
use App\Order\Domain\ValueObject\OrderItem\UserId;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Order\OrderId", columnPrefix=false)
     * @var OrderId
     */
    private OrderId $id;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\OrderItem\UserId", columnPrefix="order_")
     * @var UserId
     */
    private UserId $userId;
    /**
     * @ORM\OneToMany(targetEntity="App\Order\Domain\OrderItem", mappedBy="order", cascade={"persist", "remove"}, orphanRemoval=true)
     * @var Collection
     */
    private Collection $orderItems;
}