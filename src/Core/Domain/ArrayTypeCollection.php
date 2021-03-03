<?php

namespace App\Core\Domain;

use Doctrine\Common\Collections\ArrayCollection;

abstract class ArrayTypeCollection extends ArrayCollection
{
    public function add($element) : bool
    {
        $this->isSupport($element);

        return parent::add($element);
    }

    abstract function isSupport($element) : bool;
}