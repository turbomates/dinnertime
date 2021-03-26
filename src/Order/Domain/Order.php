<?php

namespace App\Order\Domain;

use App\Core\Domain\AggregateRoot;
use App\Order\Domain\Collection\OrderItems;
use App\Order\Domain\ValueObject\Order\OrderId;
use App\Order\Domain\ValueObject\UserId;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table(name="orders")
 */
class Order extends AggregateRoot
{
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Order\OrderId", columnPrefix=false)
     * @var OrderId
     */
    private OrderId $id;
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\UserId", columnPrefix="order_")
     * @var UserId
     */
    private UserId $userId;
    /**
     * @ORM\OneToMany(targetEntity="App\Order\Domain\OrderItem", mappedBy="order", cascade={"persist", "remove"}, orphanRemoval=true, indexBy="id.id")
     * @var Collection
     */
    private Collection $orderItems;

    public function __construct(UserId $userId)
    {
        $this->id = new OrderId();
        $this->userId = $userId;
        $this->orderItems = new OrderItems();
    }

    public function addOrderItem(OrderItem $orderItem)
    {
        $this->orderItems->add($orderItem);
    }

    //I will finish this method
    public function payOrderItem(Uuid $orderItemId) : void
    {
        if ($this->orderItems->containsKey($orderItemId->jsonSerialize())){
                $orderItem->pay();
        }
    }

    public static function create(UserId $userId) : Order
    {
        return new Order($userId);
    }
}