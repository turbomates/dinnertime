<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\Basket\BasketId;
use App\Order\Domain\ValueObject\Basket\CreatedAt;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="baskets")
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

}