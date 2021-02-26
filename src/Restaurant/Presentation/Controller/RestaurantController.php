<?php

namespace App\Restaurant\Presentation\Controller;

use App\Restaurant\Parser\GarageParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/garage/parser")
     */
    public function garageParser(Request $request, GarageParser $garageParser) : Response
    {
        $garageParser->parse();

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