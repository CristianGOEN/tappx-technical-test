<?php

declare(strict_types=1);

namespace Tappx\Network\Application\Send;

final class NetworkResponse
{
    private string $content;
    private int $statusCode;
    private array $headers;
    private int $timestamp;

    public function __construct(string $content, int $statusCode, array $headers, int $timestamp)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->timestamp = $timestamp;
    }

    public static function create(string $content, int $statusCode, array $headers, int $timestamp): self
    {
        $networkResponse = new self($content, $statusCode, $headers, $timestamp);
        return $networkResponse;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function statusCode(): int
    {
        return $this->statusCode;
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function timestamp(): int
    {
        return $this->timestamp;
    }

    public function formattResponse(): array
    {
        $formattedResponse = ['test' => 0, 'error' => 0];

        if (isset($this->headers['X-Error-Reason'])) {
            $formattedResponse['error'] = 1;
            $formattedResponse['error-reason'] = $this->headers['X-Error-Reason'][0];
        }

        if (isset($this->headers['X-Test-Ad'])) {
            if (strtolower($this->headers['X-Test-Ad'][0]) == 'Yes') {
                $formattedResponse['test'] = 1;
            }
        }

        if ($this->statusCode == 200)
            $formattedResponse['ad'] = $this->content();


        return $formattedResponse;
    }
}