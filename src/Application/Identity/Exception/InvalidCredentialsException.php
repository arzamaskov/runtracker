<?php

declare(strict_types=1);

namespace RunTracker\Application\Identity\Exception;

final class InvalidCredentialsException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Email or password is invalid.');
    }
}
