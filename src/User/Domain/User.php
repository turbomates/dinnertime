<?php

namespace App\User\Domain;

use App\core\AggregateRoot;
use App\User\Domain\ValueObject\Name;
use App\User\Domain\ValueObject\UserId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends AggregateRoot
{   /**
    * @ORM\Embedded(class="App\User\Domain\ValueObject\UserId", columnPrefix=false)
    * @var UserId
    */
    private UserId $id;
    /**
     * @ORM\Column(name="email", type="string", length=100)
     */
    private string $email;
    /**
     * @ORM\Embedded(class="App\User\Domain\ValueObject\Name", columnPrefix=false)
     * @var Name
     */
    private Name $name;
    /**
     * @ORM\Column(name="phone_number", type="integer", length=15, nullable=true)
     */
    private int $phoneNumber;

}