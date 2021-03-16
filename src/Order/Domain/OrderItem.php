<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\OrderItem\CreatedAt;
use App\Order\Domain\ValueObject\OrderItem\Dishes;
use App\Order\Domain\ValueObject\OrderItem\IsPayed;
use App\Order\Domain\ValueObject\OrderItem\OrderItemId;
use App\Order\Domain\ValueObject\OrderItem\TotalPrice;
use App\Order\Domain\ValueObject\OrderItem\UserId;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity()
 * @ORM\Table(name="order_items")
 */
class OrderItem
{
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\OrderItem\OrderItemId", columnPrefix=false)
     * @var OrderItemId
     */
    private OrderItemId $id;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\OrderItem\CreatedAt, columnPrefix=false)
     * @var CreatedAt
     */
    private CreatedAt $createdAt;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\OrderItem\UserId, columnPrefix=false)
     * @var UserId
     */
    private UserId $userId;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\OrderItem\TotalPrice, columnPrefix=false)
     * @var TotalPrice
     */
    private TotalPrice $price;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\OrderItem\IsPayed, columnPrefix=false)
     * @var IsPayed
     */
    private IsPayed $isPayed;
    /**
     * @ORM\ManyToOne(targetEntity="App\Order\Domain\Order", inversedBy="id")
     * @JoinColumn(name="order_id", referencedColumnName="id", nullable=false)
     * @var Order
     */
    private Order $order;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\OrderItem\Dishes, columnPrefix=false)
     * @var Dishes
     */
    private Dishes $dishes;
}