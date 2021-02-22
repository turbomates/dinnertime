<?php

namespace App\Core\Infrastructure\QueryHandler;

use Doctrine\ORM\EntityManagerInterface;

interface QueryObjectInterface
{
    public function execute(EntityManagerInterface $em);
}