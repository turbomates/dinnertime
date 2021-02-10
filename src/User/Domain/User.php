<?php


namespace App\User\Domain;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    public $id;
    /**
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    public $email;
    /**
     * @ORM\Column(name="first_name", type="string", length=100, nullable=false)
     */
    public $firstName;
    /**
     * @ORM\Column(name="last_name", type="string", length=100, nullable=false)
     */
    public $lastName;
    /**
     * @ORM\Column(name="phone_number", type="integer", length=15, nullable=false)
     */
    public $phoneNumber;

}