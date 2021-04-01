<?php

namespace App\Order\Domain;

use App\Core\Domain\AggregateRoot;
use App\Order\Domain\Collection\OrderItems;
use App\Order\Domain\ValueObject\Order\OrderId;
use App\Order\Domain\ValueObject\Order\User;
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
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\Order\User", columnPrefix=false)
     * @var User
     */
    private User $userInfo;
    /**
     * @ORM\OneToMany(targetEntity="App\Order\Domain\OrderItem", mappedBy="order", cascade={"persist", "remove"}, orphanRemoval=true, indexBy="id.id")
     * @var Collection
     */
    private Collection $orderItems;

    public function __construct(User $user)
    {
        $this->id = new OrderId();
        $this->orderItems = new OrderItems();
        $this->userInfo = $user;
    }

    public function addOrderItem(OrderItem $orderItem)
    {
        $this->orderItems->add($orderItem);
    }

    public function payOrderItem(Uuid $orderItemId) : void
    {
        $orderItem = $this->orderItems->get($orderItemId->jsonSerialize());
        $orderItem->pay();
    }

    public static function create(User $user) : Order
    {
        return new Order($user);
    }
}