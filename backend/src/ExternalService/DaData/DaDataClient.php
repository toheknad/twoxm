<?php

declare(strict_types=1);

namespace ExternalService\DaData;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

class DaDataClient
{
    public const REVERSE_GEOCODING_ENDPOINT = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/geolocate/address";

    private string $apiKey;
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = getenv('DA_DATA_API_KEY');
    }

    public function getCityNameByCoordinates(float $latitude, float $longitude)
    {
        $request = $this->getAuthorizedRequest('POST', self::REVERSE_GEOCODING_ENDPOINT);

        $request->getBody()->write(json_encode([
            'lat'   => $latitude,
            'lon'   => $longitude,
            'count' => 1,
        ]));

        $response = $this->httpClient->sendRequest($request);
        $responseData = json_decode((string)$response->getBody(), true);
        $suggestions = $responseData['suggestions'];
        $firstSuggestion = reset($suggestions);

        return $firstSuggestion['data']['city'];
    }

    private function getAuthorizedRequest(string $method, string $uri): RequestInterface
    {
        return new Request(
            $method,
            $uri,
            [
                "Accept"        => "application/json",
                "Content-Type"  => "application/json",
                "Authorization" => "Token {$this->apiKey}",
            ]
        );
    }
}

