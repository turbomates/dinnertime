<?php

namespace App\User\Domain;

use App\Core\Domain\AggregateRoot;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\Name;
use App\User\Domain\ValueObject\UserId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\User\Infrastructure\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends AggregateRoot
{
    /**
    * @ORM\Embedded(class="App\User\Domain\ValueObject\UserId", columnPrefix=false)
    * @var UserId
    */
    private UserId $id;
    /**
     * @ORM\Embedded(class="App\User\Domain\ValueObject\Email", columnPrefix=false)
     * @var Email
     */
    private Email $email;
    /**
     * @ORM\Embedded(class="App\User\Domain\ValueObject\Name", columnPrefix=false)
     * @var Name
     */
    private Name $name;
    /**
     * @ORM\Column(name="phone_number", type="integer", length=15, nullable=true)
     */
    private int $phoneNumber;

    private function __construct(Email $email, Name $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    public static function create(Email $email, Name $name) : self
    {
        return new static($email, $name);
    }
}