<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\CreatedAt;
use App\Order\Domain\ValueObject\OrderItem\OrderItemId;
use App\Order\Domain\ValueObject\Price;
use App\Order\Domain\ValueObject\UserId;
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
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\CreatedAt", columnPrefix=false)
     * @var CreatedAt
     */
    private CreatedAt $createdAt;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\UserId", columnPrefix=false)
     * @var UserId
     */
    private UserId $userId;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Price", columnPrefix="total_")
     * @var Price
     */
    private Price $totalPrice;
    /**
     * @ORM\Column(name="is_payed", type="boolean", length=10)
     */
    private bool $isPayed;
    /**
     * @ORM\ManyToOne(targetEntity="App\Order\Domain\Order", inversedBy="id")
     * @JoinColumn(name="order_id", referencedColumnName="id", nullable=false)
     * @var Order
     */
    private Order $order;
    /**
     * @ORM\Column(name="dishes", type="json", length=255)
     */
    private string $dishes;

    public function __construct(UserId $userId, Price $totalPrice, Order $order, string $dishes)
    {
        $this->id = new OrderItemId();
        $this->createdAt = new CreatedAt();
        $this->userId = $userId;
        $this->totalPrice = $totalPrice;
        $this->isPayed = false;
        $this->order = $order;
        $this->dishes = $dishes;
    }

    public function pay() : void
    {
        $this->isPayed = true;
    }

    public function userId() : UserId
    {
        return $this->userId;
    }

}