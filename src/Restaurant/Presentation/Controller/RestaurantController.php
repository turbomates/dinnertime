<?php

namespace App\Restaurant\Presentation\Controller;

use App\Core\Infrastructure\QueryHandler\QueryExecutor;
use App\Restaurant\Domain\ValueObject\Restaurant\Name;
use App\Restaurant\Infrastructure\QueryObject\DishQuery;
use App\Restaurant\Infrastructure\QueryObject\RestaurantQuery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RestaurantController extends AbstractController
{
    private EntityManagerInterface $em;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/restaurants")
     */
    public function restaurants(QueryExecutor $queryExecutor) : Response
    {
        $restaurants = $queryExecutor->execute(new RestaurantQuery());

        return new JsonResponse($restaurants);
    }

    /**
     * @Route("/{restaurant}/dishes")
     */
    public function dishes(QueryExecutor $queryExecutor, string $restaurant) : Response
    {
        $name = new Name($restaurant);
        $dishes = $queryExecutor->execute(new DishQuery($name));

        return new JsonResponse($dishes);
    }
}