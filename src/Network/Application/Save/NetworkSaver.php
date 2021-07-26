<?php

declare(strict_types=1);

namespace Tappx\Network\Application\Save;

use Tappx\Network\Application\Send\NetworkResponse;
use Tappx\Network\Domain\NetworkRepository;

final class NetworkSaver
{
    private NetworkRepository $repository;

    public function __construct(NetworkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(NetworkResponse $networkResponse): void
    {
        $this->repository->save($networkResponse);
    }
}