<?php

declare(strict_types=1);

namespace RunTracker\Application\Identity\Exception;

use RunTracker\Domain\Identity\ValueObject\Email;

final class UserAlreadyExistsException extends \DomainException
{
    public function __construct(Email $email)
    {
        parent::__construct(sprintf('User with email "%s" already exists.', $email->value()));
    }
}
