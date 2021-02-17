<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function get100CryptoData($currency)
    {
        $response = $this->client->request(
            'GET',
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?start=1&limit=5&convert=' . $currency . '&CMC_PRO_API_KEY=111f3536-380c-4e85-8d58-2bf67b21b2e7'
        );

        return $response->getContent();
    }

    public function getSpcificCrypto($symbol, $currency)
    {
        $response = $this->client->request(
            'GET',
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?symbol=' . $symbol . '&convert=' . $currency . '&CMC_PRO_API_KEY=111f3536-380c-4e85-8d58-2bf67b21b2e7'
        );

        return $response->getContent();
    }
}
