<?php

namespace App\User\Presentation\Controller;

use App\Core\Infrastructure\QueryHandler\QueryExecutor;
use App\User\Application\Command\ChangePhoneNumber;
use App\User\Application\Command\Rename;
use App\User\Application\UserHandler;
use App\User\Domain\ValueObject\UserId;
use App\User\Infrastructure\QueryObject\UserQuery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    private UserHandler $handler;
    private SerializerInterface $serializer;
    private EntityManagerInterface $em;

    public function __construct(UserHandler $handler, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->handler = $handler;
        $this->serializer = $serializer;
        $this->em = $em;
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
    public function rename(Request $request, TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $renameCommand = $this->deserializeJson($request->getContent(), Rename::class, [
            'default_constructor_arguments' => [
                Rename::class => [
                    'user' => $user
                ]
            ]
        ]);
        $this->em->transactional(function () use ($renameCommand) {
            $this->handler->rename($renameCommand);
        });

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/api/user/change-phone-number")
     */
    public function changePhoneNumber(Request $request, TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $changeNumberCommand = $this->deserializeJson($request->getContent(), ChangePhoneNumber::class, [
            'default_constructor_arguments' => [
                ChangePhoneNumber::class => [
                    'user' => $user
                ]
            ]
        ]);
        $this->em->transactional(function () use ($changeNumberCommand) {
            $this->handler->changePhoneNumber($changeNumberCommand);
        });

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/api/user")
     */
    public function user(UserId $userId, QueryExecutor $queryExecutor): Response
    {
        $user = $queryExecutor->execute(new UserQuery($userId));

        return new JsonResponse($user);
    }

    private function deserializeJson(string $json, string $type, array $context)
    {
        return $this->serializer->deserialize($json, $type, 'json', $context);
    }
}
