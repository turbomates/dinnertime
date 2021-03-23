<?php

namespace App\Order\Presentation\Controller;

use App\Order\Application\OrderHandler;
use App\Order\Domain\ValueObject\UserId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private OrderHandler $handler;

    public function __construct(OrderHandler $handler)
    {
        $this->handler = $handler;
    }
    //I just started
    /**
     * @Route("/api/order")
     */
    public function order(UserId $userId) : Response
    {
        $this->handler->makeOrder($userId);

        return new JsonResponse(['status' => 'ok']);
    }
}