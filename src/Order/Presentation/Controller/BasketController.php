<?php

namespace App\Order\Presentation\Controller;

use App\Order\Application\BasketHandler;
use App\Order\Application\Command\AddToBasket;
use App\Order\Application\Command\RemoveDish;
use App\Order\Domain\ValueObject\Basket\UserId;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

class BasketController extends AbstractController
{
    private EntityManagerInterface $em;
    private BasketHandler $handler;
    private TokenStorageInterface $tokenStorage;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $em, BasketHandler $handler, TokenStorageInterface $tokenStorage,
        SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->handler = $handler;
        $this->tokenStorage = $tokenStorage;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/basket/add/dish")
     */
    public function addDish(UserId $userId, AddToBasket $addToBasket) : Response
    {
        $this->em->transactional(function () use ($addToBasket, $userId){
            $this->handler->addToBasket($addToBasket, $userId);
        });

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/api/basket/remove/dish")
     */
    public function removeDish(UserId $userId, RemoveDish $removeDish) : Response
    {
        $this->em->transactional(function () use ($removeDish, $userId){
           $this->handler->removeDish($userId, $removeDish);
        });

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/api/basket/list")
     */
    public function listDishes() : Response
    {
        return new JsonResponse(['status' => 'ok']);
    }
}