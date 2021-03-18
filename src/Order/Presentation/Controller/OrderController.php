<?php

namespace App\Order\Presentation\Controller;

use App\Order\Application\BasketHandler;
use App\Order\Application\Command\AddToBasket;
use App\Order\Domain\ValueObject\Basket\UserId;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

class OrderController extends AbstractController
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
     * @Route("/api/basket")
     */
    public function basket(UserId $userId, Request $request) : Response
    {
        $dishes = $this->serializer->deserialize($request->getContent(), AddToBasket::class,'json');
        $this->em->transactional(function () use ($dishes, $userId){
            $this->handler->addToBasket($dishes, $userId);
        });

        return new JsonResponse(['status' => 'ok']);
    }
}