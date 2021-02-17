<?php

namespace App\User\Presentation\Controller;

use App\User\Application\UserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;

class UserController extends AbstractController
{
    private UserHandler $handler;

    public function __construct(UserHandler $handler)
    {
        $this->handler = $handler;
    }
    /**
     * @Route("/users", name="register")
     */
    public function register(Request $request): Response
    {
        return new JsonResponse(['status' => 'ok']);
    }
    /**
     * @Route("/homepage", name="app_homepage")
     */
    public function homepage() : Response
    {
        return $this->render('userRegister.html.twig');
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    /**
     * @Route("/user/rename")
     */
    public function rename() : Response
    {
        return new JsonResponse();
    }
    /**
     * @Route("/user/change-phone-number")
     */
    public function changePhoneNumber() : Response
    {
        return new JsonResponse();
    }
    /**
     * @Route("/user")
     */
    public function user() : Response
    {
        $user = $this->handler->user();

        return $this->json($user);
    }

}

