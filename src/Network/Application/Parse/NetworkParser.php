<?php

declare(strict_types=1);

namespace Tappx\Network\Application\Parse;

use Tappx\Network\Domain\NetworkRepository;

final class NetworkParser
{
    private NetworkRepository $repository;

    public function __construct(NetworkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $requestFilePath): array
    {
        return $this->repository->parse($requestFilePath);
    }
}