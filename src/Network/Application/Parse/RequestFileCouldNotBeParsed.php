<?php

declare(strict_types=1);

namespace Tappx\Network\Application\Parse;

use RuntimeException;

final class RequestFileCouldNotBeParsed extends RuntimeException
{
    public function __construct()
    {
        parent::__construct("Couldn't parse the request file");
    }
}