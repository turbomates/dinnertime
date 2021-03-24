<?php

namespace App\Order\Presentation\Controller;

use App\Order\Application\OrderHandler;
use App\Order\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private OrderHandler $handler;
    private EntityManagerInterface $em;

    public function __construct(OrderHandler $handler, EntityManagerInterface $em)
    {
        $this->handler = $handler;
        $this->em = $em;
    }

    /**
     * @Route("/api/order/make")
     */
    public function order(UserId $userId) : Response
    {
        $this->em->transactional(function () use ($userId){
            $this->handler->makeOrder($userId);
        });

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/api/order")
     */
    public function orderList() : Response
    {
        return new JsonResponse(['status' => 'ok']);
    }
}