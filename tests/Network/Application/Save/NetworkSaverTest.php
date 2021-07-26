<?php

declare(strict_types=1);

namespace Network\Application\Save;

use PHPUnit\Framework\TestCase;
use Tappx\Network\Application\Save\NetworkSaver;
use Tappx\Network\Application\Send\NetworkResponse;
use Tappx\Network\Domain\NetworkRepository;

final class NetworkSaverTest extends TestCase
{
    /** @test */
    public function it_should_be_able_to_save_json_file(): void
    {
        $repository = $this->createMock(NetworkRepository::class);
        $parser = new NetworkSaver($repository);

        $dummyNetworkResponse = new NetworkResponse('content', 200, [], time());

        $repository->expects($this->once())->method("save")->with($dummyNetworkResponse);
        $parser->__invoke($dummyNetworkResponse);
    }
}