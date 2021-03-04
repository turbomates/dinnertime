<?php

namespace App\Restaurant\Presentation\Controller;

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

    //I don't finished yet
    /**
     * @Route("/garage/parser")
     */
    public function garageParser(Request $request, Garage $garageParser) : Response
    {
        $restaurant = $garageParser->parse();

        return new JsonResponse(['status' => 'ok']);
    }

    /**
     * @Route("/tempo/parser")
     */
    public function tempoParser(Request $request, Tempo $tempoParser) : Response
    {
        $restaurant = $tempoParser->parse();

        return new JsonResponse(['status' => 'ok']);
    }
}