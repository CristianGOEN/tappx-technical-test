<?php

declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

use Dotenv\Dotenv;
use Tappx\Network\Application\Parse\NetworkParser;
use Tappx\Network\Application\Save\NetworkSaver;
use Tappx\Network\Application\Send\NetworkSender;
use Tappx\Network\Domain\Network;
use Tappx\Network\Infrastructure\GuzzleNetworkRepository;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$guzzleNetwork = new GuzzleNetworkRepository();

$networkParser = new NetworkParser($guzzleNetwork);
$parsedRequest = $networkParser->__invoke('./Request.txt');

$network = new Network($_ENV['API_KEY'], (int)$_ENV['API_TIMEOUT'], (int)$_ENV['API_TEST_MODE'], $parsedRequest);

$networkSender = new NetworkSender($guzzleNetwork);
$networkResponse = $networkSender->__invoke($network);

$networkSaver = new NetworkSaver($guzzleNetwork);
$networkSaver->__invoke($networkResponse);