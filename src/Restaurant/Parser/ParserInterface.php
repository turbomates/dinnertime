<?php

namespace App\Restaurant\Parser;

use Doctrine\Common\Collections\ArrayCollection;

interface ParserInterface
{
    public function parse();
}