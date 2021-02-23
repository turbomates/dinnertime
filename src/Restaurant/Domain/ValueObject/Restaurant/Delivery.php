<?php

namespace App\Restaurant\Domain\ValueObject\Restaurant;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Delivery
{
    /**
     * @ORM\Column(name="min_delivery_price", type="float", length=10)
     */
    private float $minDeliveryPrice;
    /**
     * @ORM\Column(name="delivery_cost", type="float", length=10)
     */
    private float $deliveryCost;

    public function __construct(float $minDeliveryPrice, float $deliveryCost)
    {
        $this->minDeliveryPrice = $minDeliveryPrice;
        $this->deliveryCost = $deliveryCost;
    }
}