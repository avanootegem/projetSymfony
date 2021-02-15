<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{ 
    /**
     * @Route("/{currency}", name="home")
     */
    public function index(CallApiService $api, $currency = "EUR") : Response
    { 
      $value = $api->get100CryptoData($currency);
      $data = $value['data'];

      dump($value);

      return new Response($this->renderView('pages/home.html.twig', 
        [
          "datas" => $data,
          "currency" => $currency
        ]
      ));
    }

    /**
     * @Route("/crypto/{symbol}_{currency}", name="crypto")
     */
    public function crypto(CallApiService $api, $symbol, $currency) : Response
    {
      $value = $api->getSpcificCrypto($symbol, $currency);
      $data = $value['data'];

      dump($data);

      return new Response($this->renderView('pages/crypto.html.twig', ["datas" => $data]));
    }
}