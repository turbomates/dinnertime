<?php

namespace App\Order\Presentation\Controller;

use App\Core\Infrastructure\QueryHandler\QueryExecutor;
use App\Order\Application\BasketHandler;
use App\Order\Application\Command\AddToBasket;
use App\Order\Application\Command\RemoveDish;
use App\Order\Domain\ValueObject\UserId;
use App\Order\Infrastructure\QueryObject\BasketDishQuery;
use App\Order\Infrastructure\QueryObject\BasketQuery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    private EntityManagerInterface $em;
    private BasketHandler $handler;
    private QueryExecutor $queryExecutor;

    public function __construct(EntityManagerInterface $em, BasketHandler $handler, QueryExecutor $queryExecutor)
    {
        $this->em = $em;
        $this->handler = $handler;
        $this->queryExecutor = $queryExecutor;
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
     * @Route("/api/basket/user")
     */
    public function basketUser(UserId $userId) : Response
    {
        $basket = $this->queryExecutor->execute(new BasketDishQuery($userId));

        return new JsonResponse($basket);
    }

    /**
     * @Route("/api/basket")
     */
    public function basket(UserId $userId) : Response
    {
        $basket = $this->queryExecutor->execute(new BasketQuery());

        return new JsonResponse($basket);
    }
}