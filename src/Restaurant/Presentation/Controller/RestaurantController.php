<?php

namespace App\Restaurant\Presentation\Controller;

use App\Core\Infrastructure\QueryHandler\QueryExecutor;
use App\Restaurant\Domain\ValueObject\Restaurant\Name;
use App\Restaurant\Infrastructure\QueryObject\DishQuery;
use App\Restaurant\Infrastructure\QueryObject\RestaurantQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    private QueryExecutor $queryExecutor;

    public function __construct(QueryExecutor $queryExecutor)
    {
        $this->queryExecutor = $queryExecutor;
    }

    /**
     * @Route("/restaurants")
     */
    public function restaurants() : Response
    {
        $restaurants = $this->queryExecutor->execute(new RestaurantQuery());

        return new JsonResponse($restaurants);
    }

    /**
     * @Route("/{restaurant}/dishes")
     */
    public function dishes(string $restaurant) : Response
    {
        $name = new Name($restaurant);
        $dishes = $this->queryExecutor->execute(new DishQuery($name));

        return new JsonResponse($dishes);
    }
}