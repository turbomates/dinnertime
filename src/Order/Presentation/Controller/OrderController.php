<?php

namespace App\Order\Presentation\Controller;

use App\Core\Infrastructure\QueryHandler\QueryExecutor;
use App\Order\Application\Command\IsPayed;
use App\Order\Application\OrderHandler;
use App\Order\Domain\ValueObject\UserId;
use App\Order\Infrastructure\QueryObject\OrderItemsQuery;
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
     * @Route("api/order/is/payed")
     */
    public function isPayed(IsPayed $isPayed) : Response
    {
        $this->em->transactional(function () use ($isPayed){
           $this->handler->isPayed($isPayed);
        });

        return new JsonResponse(['status' => 'ok']);
    }
}