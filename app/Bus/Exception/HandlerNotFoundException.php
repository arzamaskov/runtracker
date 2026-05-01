<?php

declare(strict_types=1);

namespace App\Bus\Exception;

final class HandlerNotFoundException extends \RuntimeException
{
    public function __construct(string $messageClass)
    {
        parent::__construct(sprintf('Handler for message "%s" was not found.', $messageClass));
    }
}
