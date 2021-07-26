<?php

declare(strict_types=1);

namespace Network\Application\Parse;

use PHPUnit\Framework\TestCase;
use Tappx\Network\Application\Parse\NetworkParser;
use Tappx\Network\Domain\NetworkRepository;

final class NetworkParserTest extends TestCase
{
    /** @test */
    public function it_should_be_able_to_parse_json_file(): void
    {
        $repository = $this->createMock(NetworkRepository::class);
        $parser = new NetworkParser($repository);

        $requestFilePath = './Request.txt';

        $repository->expects($this->once())->method("parse")->with($requestFilePath);
        $parser->__invoke($requestFilePath);
    }
}