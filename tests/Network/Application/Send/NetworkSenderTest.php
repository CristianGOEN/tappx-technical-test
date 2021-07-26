<?php

declare(strict_types=1);

namespace Network\Application\Send;

use PHPUnit\Framework\TestCase;
use Tappx\Network\Application\Send\NetworkResponse;
use Tappx\Network\Application\Send\NetworkSender;
use Tappx\Network\Domain\Network;
use Tappx\Network\Domain\NetworkRepository;

final class NetworkSenderTest extends TestCase
{
    /** @test */
    public function it_should_be_able_to_send_json_file(): void
    {
        $repository = $this->createMock(NetworkRepository::class);
        $sender = new NetworkSender($repository);

        $dummyNetwork = new Network('',400,0,[]);
        $dummyNetworkResponse = new NetworkResponse('content', 200, [], time());

        $repository->expects($this->once())->method("send")->with($dummyNetwork)->willReturn($dummyNetworkResponse);
        $sender->__invoke($dummyNetwork);
    }
}