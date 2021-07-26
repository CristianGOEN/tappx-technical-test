<?php

declare(strict_types=1);

namespace Tappx\Network\Application\Parse;

use RuntimeException;

final class RequestFileDoesNotExist extends RuntimeException
{
    public function __construct()
    {
        parent::__construct("Couldn't find request file");
    }
}