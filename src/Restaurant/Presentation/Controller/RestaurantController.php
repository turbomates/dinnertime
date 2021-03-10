<?php

namespace App\Restaurant\Presentation\Controller;

use App\Core\Infrastructure\QueryHandler\QueryExecutor;
use App\Restaurant\Parser\Garage;
use App\Restaurant\Parser\Tempo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/garage/parser")
     */
    public function garageParser(Request $request, Garage $garageParser) : Response
    {
        $this->em->transactional(function () use ($garageParser){
            $garageParser->getRestaurant();
        });

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/tempo/parser")
     */
    public function tempoParser(Request $request, Tempo $tempoParser) : Response
    {
        $this->em->transactional(function () use ($tempoParser){
           $tempoParser->getRestaurant();
        });

        return new JsonResponse(['status' => 'ok']);
    }
}