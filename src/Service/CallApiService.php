<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->key = "6ab675c5-fc5e-4796-8bb7-4fca13f262fa";
    }

    public function get100CryptoData($currency)
    {
        $response = $this->client->request(
            'GET',
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?start=1&limit=5&convert=' . $currency . '&CMC_PRO_API_KEY='.$this->key
        );

        return $response->getContent();
    }

    public function getSpcificCrypto($symbol, $currency)
    {
        $response = $this->client->request(
            'GET',
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?symbol=' . $symbol . '&convert=' . $currency . '&CMC_PRO_API_KEY='.$this->key
        );

        return $response->getContent();
    }

    public function getDescription($symbol)
    {
        $response = $this->client->request(
            'GET',
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/info?symbol='. $symbol .'&CMC_PRO_API_KEY='.$this->key
        );

        return $response->getContent();
    }
}
