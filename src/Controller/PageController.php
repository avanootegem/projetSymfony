<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(CallApiService $api) : Response
    { 
      $value = $api->get20CryptoData();
      $data = $value['data'];

      return new Response($this->renderView('pages/home.html.twig', ["data" => $data]));
    }
}