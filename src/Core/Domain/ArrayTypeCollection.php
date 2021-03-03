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

    public function set($key, $value)
    {
        parent::set($key, $value);
    }

    public function remove($key)
    {
        return parent::remove($key);
    }

    public function clear()
    {
        parent::clear();
    }

    public function removeElement($element) : bool
    {
        return parent::removeElement($element);
    }
}