<?php

namespace App\User\Domain;

use App\Core\Domain\AggregateRoot;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\Name;
use App\User\Domain\ValueObject\PhoneNumber;
use App\User\Domain\ValueObject\UserId;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User extends AggregateRoot implements UserInterface
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
     * @ORM\Embedded(class="App\User\Domain\ValueObject\PhoneNumber", columnPrefix=false)
     * @var PhoneNumber
     */
    private PhoneNumber $phoneNumber;

    public function __construct(Email $email, Name $name)
    {
        $this->id = new UserId();
        $this->email = $email;
        $this->name = $name;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public static function create(Email $email, Name $name) : self
    {
        return new static($email, $name);
    }

    public function getUsername() : string
    {
        return $this->email->address();
    }

    public function rename(Name $name) : void
    {
        $this->name = $name;
    }

    public function changePhoneNumber(PhoneNumber $phoneNumber) : void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getRoles()
    {
        return [];
    }

    public function getPassword()
    {

    }

    public function getSalt()
    {

    }

    public function eraseCredentials()
    {

    }
}