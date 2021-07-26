<?php

declare(strict_types=1);

namespace Tappx\Network\Infrastructure;

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use Tappx\Network\Application\Parse\RequestFileCouldNotBeParsed;
use Tappx\Network\Application\Parse\RequestFileDoesNotExist;
use Tappx\Network\Application\Send\NetworkResponse;
use Tappx\Network\Domain\Network;
use Tappx\Network\Domain\NetworkRepository;
use GuzzleHttp\Psr7;

final class GuzzleNetworkRepository implements NetworkRepository
{
    private array $headers;

    public function __construct()
    {
        $this->headers = [
            'x-openrtb-version' => 2.3,
            'Content-Type' => 'application/json'
        ];

        $dotenv = Dotenv::createImmutable('.');
        $dotenv->load();
    }

    public function send(Network $network): NetworkResponse
    {
        $client = new Client([
            'base_uri' => $_ENV['API_URL'],
            'verify' => false,
            'headers' => $this->headers,
            'query' => $network->params()
        ]);

        $response = $client->request('GET');

        $networkResponse = NetworkResponse::create($response->getBody()->getContents(), $response->getStatusCode(), $response->getHeaders(), time());

        return $networkResponse;
    }

    public function parse(string $requestPath): array
    {
        try {
            $resource = Psr7\Utils::tryFopen($requestPath, 'r');
        } catch (\Throwable $e) {
            throw new RequestFileDoesNotExist();
        }

        $stream = Psr7\Utils::streamFor($resource);
        $parsedRequest = json_decode($stream->getContents(), true);

        if ($parsedRequest === null)
            throw new RequestFileCouldNotBeParsed();

        return $parsedRequest;
    }

    public function save(NetworkResponse $networkResponse)
    {
        $resource = fopen($_ENV['API_OUTPUT_PATH']."/".$networkResponse->timestamp().'.json', 'w');
        $stream = Psr7\Utils::streamFor($resource);
        $stream->write(json_encode($networkResponse->formattResponse()));
    }
}