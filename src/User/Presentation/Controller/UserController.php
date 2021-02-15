<?php

namespace App\User\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="register")
     */
    public function register(Request $request): Response
    {
        return new JsonResponse(['status' => 'ok']);

        //return $this->render('userRegister');
    }
}

