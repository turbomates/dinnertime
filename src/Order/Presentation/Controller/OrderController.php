<?php

namespace App\Order\Presentation\Controller;

use App\Core\Infrastructure\QueryHandler\QueryExecutor;
use App\Order\Application\Command\PayOrderItem;
use App\Order\Application\OrderHandler;
use App\Order\Domain\Order;
use App\Order\Domain\ValueObject\UserId;
use App\Order\Infrastructure\QueryObject\OrderItemsQuery;
use App\Order\Infrastructure\QueryObject\OrderQuery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private OrderHandler $handler;
    private EntityManagerInterface $em;
    private QueryExecutor $queryExecutor;


    public function __construct(OrderHandler $handler, EntityManagerInterface $em, QueryExecutor $queryExecutor)
    {
        $this->handler = $handler;
        $this->em = $em;
        $this->queryExecutor = $queryExecutor;
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
        $order = $this->queryExecutor->execute(new OrderItemsQuery());

        return new JsonResponse($order);
    }

    /**
     * @Route("/api/order/{order}/user/payed")
     */
    public function userPayed(PayOrderItem $pay, Order $order) : Response
    {
        $this->em->transactional(function () use ($pay, $order){
            $this->handler->payOrderItem($pay, $order);
        });

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/api/order/user/not/payed")
     */
    public function haveToPayList(UserId $userId) : Response
    {
        $users = $this->queryExecutor->execute(new OrderQuery($userId));

        return new JsonResponse($users);
    }
}