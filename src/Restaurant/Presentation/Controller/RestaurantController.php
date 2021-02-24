<?php

namespace App\Restaurant\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DomCrawler\Crawler;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/crawler")
     */
    public function crawler(Request $request) : Response
    {
        $url = 'https://garage.by/menu/domashnjajaeda1130-2300/';
        $html = file_get_contents($url);

        $crawler = new Crawler($html);

        $name = $crawler->filter('h1')->text();
        var_dump($name);
        exit();


        foreach ($crawler as $domElement) {
            var_dump($domElement);
        }
        exit();


//        $client = new \GuzzleHttp\Client();
//        $res = $client->request('GET', $url);
//        $html = ''.$res->getBody();
 //       $crawler = new Crawler($url);

//        foreach ($crawler as $domElement) {
//            var_dump($domElement);
//        }
//        exit();


        //$crawler->filter('body')->children('p.lorem');
        //$crawler = $crawler->filterXPath('descendant-or-self::body/p');
       // $crawler = $crawler->filter('body > p');


        //var_dump($domElement->nodeName)
        //return new JsonResponse(['status' => 'ok']);
    }
}