<?php

namespace App\Core\Infrastructure\QueryHandler;

use Doctrine\ORM\EntityManagerInterface;

interface QueryObject
{
    public function execute(EntityManagerInterface $em) : array;
}