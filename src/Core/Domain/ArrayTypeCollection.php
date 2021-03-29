<?php

namespace App\Core\Domain;

use Doctrine\Common\Collections\ArrayCollection;

abstract class ArrayTypeCollection extends ArrayCollection
{
    abstract function isSupport($element) : bool;

    public function add($element) : bool
    {
        $this->isSupport($element);

        return parent::add($element);
    }

    public function set($key, $value) : void
    {
        $this->isSupport($value);
        parent::set($key, $value);
    }

    public function removeElement($element) : bool
    {
        $this->isSupport($element);

        return parent::removeElement($element);
    }
}