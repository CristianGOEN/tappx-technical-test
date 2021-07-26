<?php

declare(strict_types=1);

namespace Network\Infrastructure;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use Tappx\Network\Application\Parse\RequestFileCouldNotBeParsed;
use Tappx\Network\Application\Parse\RequestFileDoesNotExist;
use Tappx\Network\Domain\Network;
use Tappx\Network\Infrastructure\GuzzleNetworkRepository;

final class GuzzleNetworkRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::createImmutable('.');
        $dotenv->load();
    }

    /** @test */
    public function it_should_parse_a_request(): void
    {
        $repository = new GuzzleNetworkRepository();
        $parsedRequest = $repository->parse('./Request.txt');
        $this->assertNotNull($parsedRequest);
    }

    /** @test */
    public function it_should_throw_an_exception_if_request_file_does_not_exist(): void
    {
        $this->expectException(RequestFileDoesNotExist::class);
        $repository = new GuzzleNetworkRepository();
        $repository->parse('./xxxxx.txt');
    }

    /** @test */
    public function it_should_throw_an_exception_if_request_file_can_not_be_parsed(): void
    {
        $this->expectException(RequestFileCouldNotBeParsed::class);
        $repository = new GuzzleNetworkRepository();
        $repository->parse('./tests/Network/Infrastructure/RequestTypeError.txt');
    }

    /** @test */
    public function it_should_send_a_request(): void
    {
        $repository = new GuzzleNetworkRepository();
        $parsedRequest = $repository->parse('./Request.txt');
        $network = new Network($_ENV['API_KEY'], 800, 1, $parsedRequest);
        $repository->send($network);
    }

    /** @test */
    public function it_should_create_output_response_file(): void
    {
        $repository = new GuzzleNetworkRepository();
        $parsedRequest = $repository->parse('./Request.txt');
        $network = new Network($_ENV['API_KEY'], 800, 1, $parsedRequest);
        $networkResponse = $repository->send($network);

        $repository->save($networkResponse);
        $filename = $_ENV['API_OUTPUT_PATH']."/".$networkResponse->timestamp().'.json';

        $this->assertFileExists(
            $filename,
            "exist"
        );
    }
}