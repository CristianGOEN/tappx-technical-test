<?php

declare(strict_types=1);

namespace Tappx\Network\Application\Send;

use Tappx\Network\Domain\Network;
use Tappx\Network\Domain\NetworkRepository;

final class NetworkSender
{
    private NetworkRepository $repository;

    public function __construct(NetworkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Network $network): NetworkResponse
    {
        return $this->repository->send($network);
    }
}