<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CallApiService $api) : Response
    { 
      $value = $api->get20CryptoData();
      $data = $value['data'];

      dump($value);

      return new Response($this->renderView('pages/home.html.twig', ["datas" => $data]));
    }

    /**
     * @Route("/crypto/{id}", name="crypto")
     */
    public function crypto(CallApiService $api, $id) : Response
    {
      $value = $api->getSpcificCrypto($id);
      $data = $value['data'];

      dump($data);

      return new Response($this->renderView('pages/crypto.html.twig', ["datas" => $data]));
    }
}