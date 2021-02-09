<?php

namespace App\User\Controller;

use App\User\Command\Handler;
use App\User\Command\Register;
use App\User\Entity\User;
use App\User\Form\RegistrationForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{

    /**
     * @Route("/users", name="app_users_register")
     */
    public function register(Request $request): Response
    {

    }
}

