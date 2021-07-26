<?php

declare(strict_types=1);

namespace Tappx\Network\Domain;

use Tappx\Network\Application\Send\NetworkResponse;

interface NetworkRepository
{
    public function send(Network $network): NetworkResponse;
    public function parse(string $requestPath): array;
    public function save(NetworkResponse $networkResponse);
}