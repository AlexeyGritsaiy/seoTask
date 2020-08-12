<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class DataForSeoHttpClient
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getSearchEngines(): array
    {
        try {
            $result = $this->client->get('/v2/cmn_se');

            return $this->formatResponse($result);
        } catch (ClientException $clientException) {
            throw $clientException;
        }
    }

    private function formatResponse(ResponseInterface $response): array
    {
        $data = (array)json_decode($response->getBody()->getContents(), true);

        if (!isset($data['results'])) {
            throw new \RuntimeException('Undefined response from client.');
        }

        return $data['results'];
    }

    public function getLocations(string $countryIsoCode): array
    {
        try {
            $result = $this->client->get('/v2/cmn_locations/'.$countryIsoCode);

            return $this->formatResponse($result);
        } catch (ClientException $clientException) {
            throw $clientException;
        }
    }

    public function createTask(int $id, array $data): array
    {
        try {
            $result = $this->client->post('/v2/srp_tasks_post', [
                RequestOptions::JSON => [
                    'data' => [
                        "$id" => $data,
                    ],
                ],
            ]);

            return $this->formatResponse($result);
        } catch (ClientException $clientException) {
            throw $clientException;
        }
    }


    public function getTask(int $id): array
    {
        try {
            $result = $this->client->get('/v2/srp_tasks_get/'.$id);

            return $this->formatResponse($result);
        } catch (ClientException $clientException) {
            throw $clientException;
        }
    }
}
