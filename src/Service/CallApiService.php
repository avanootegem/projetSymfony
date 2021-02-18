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
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?start=1&limit=5&convert=' . $currency . '&CMC_PRO_API_KEY=8b768af1-85b2-49b5-9214-cc71ba81af8f'
        );

        return $response->getContent();
    }

    public function getSpcificCrypto($symbol, $currency)
    {
        $response = $this->client->request(
            'GET',
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?symbol=' . $symbol . '&convert=' . $currency . '&CMC_PRO_API_KEY=8b768af1-85b2-49b5-9214-cc71ba81af8f'
        );

        return $response->getContent();
    }
}
