<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
  /**
   * @Route("/{currency}_json", name="home_json")
   */
  public function home_json(CallApiService $api, $currency): Response
  {
    $value = $api->get100CryptoData($currency);
    return new Response($value);
  }

  /**
   * @Route("/{currency}", name="home")
   */
  public function home($currency = "EUR"): Response
  {
    return new Response($this->renderView(
      'pages/home.html.twig',
      ["currency" => $currency]
    ));
  }

  /**
   * @Route("/crypto/{symbol}_{currency}_json", name="crypto_json")
   */
  public function crypto_json(CallApiService $api, $symbol, $currency): Response
  {
    $value = $api->getSpcificCrypto($symbol, $currency);

    return new Response($value);
  }

  /**
   * @Route("/crypto/{symbol}_{currency}", name="crypto")
   */
  public function crypto($symbol = "BTC", $currency = "EUR"): Response
  {
    return new Response($this->renderView(
      'pages/crypto.html.twig',
      [
        "currency" => $currency,
        "symbol" => $symbol
      ]
    ));
  }
}
