<?php

namespace App\Restaurant\Presentation\Controller;

use App\Restaurant\Application\RestaurantHandler;
use App\Restaurant\Parser\GarageParser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    private RestaurantHandler $handler;

    public function __construct(RestaurantHandler $handler)
    {
        $this->handler = $handler;
    }
    /**
     * @Route("/garage/parser")
     */
    public function garageParser(Request $request, GarageParser $garageParser) : Response
    {
       $restaurant = $garageParser->parse();
       $this->handler->handlerParseRestaurant($restaurant);

       return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/tempo/parser")
     */
    public function tempoParser(Request $request) : Response
    {
        return new JsonResponse(['status' => 'ok']);
    }
}