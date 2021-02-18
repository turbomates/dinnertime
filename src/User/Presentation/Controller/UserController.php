<?php

namespace App\User\Presentation\Controller;

use App\User\Application\Command\ChangePhoneNumber;
use App\User\Application\Command\Rename;
use App\User\Application\UserHandler;
use App\User\Domain\User;
use App\User\Domain\ValueObject\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    private UserHandler $handler;

    public function __construct(UserHandler $handler,)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/api/users", name="register")
     */
    public function register(Request $request): Response
    {
        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/homepage", name="app_homepage")
     */
    public function homepage(TokenStorageInterface $token): Response
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
     * @Route("/api/user/rename")
     */
    public function rename(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $renameCommand = $serializer->deserialize($request->getContent(), Rename::class, 'json', [
            'default_constructor_arguments' => [
                Rename::class => [
                    'user' => $user
                ]
            ]
        ]);
        $em->transactional(function () use ($renameCommand) {
            $this->handler->rename($renameCommand);
        });

        return new JsonResponse();
    }

    /**
     * @Route("/api/user/change-phone-number")
     */
    public function changePhoneNumber(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $changeNumberCommand = $serializer->deserialize($request->getContent(), ChangePhoneNumber::class, 'json', [
            'default_constructor_arguments' => [
                ChangePhoneNumber::class => [
                    'user' => $user
                ]
            ]
        ]);
        $em->transactional(function () use ($changeNumberCommand) {
            $this->handler->changePhoneNumber($changeNumberCommand);
        });

        return new JsonResponse();
    }

    /**
     * @Route("/api/user")
     */
    public function user(TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();

        return new JsonResponse(['data' => $user]);
    }

    private function deserializeJson(string $json, string $type, array $context)
    {
        $this->serilizer->deserialize($json, $type, 'json', $context);
    }
}

