<?php


namespace App\Core\Infrastructure\Repository;


interface UserRepositoryInterface
{
    public function add();

    public function findByEmail();
}