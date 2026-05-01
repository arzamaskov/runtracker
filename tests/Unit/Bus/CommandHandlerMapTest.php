<?php

declare(strict_types=1);

namespace Tests\Unit\Bus;

use App\Bus\CommandHandlerMap;
use App\Bus\Exception\HandlerNotFoundException;
use PHPUnit\Framework\TestCase;
use stdClass;

class CommandHandlerMapTest extends TestCase
{
    public function test_it_returns_handler_for_message(): void
    {
        $message = new DummyCommandMessage;

        $map = new CommandHandlerMap([
            DummyCommandMessage::class => DummyCommandHandler::class,
        ]);

        $this->assertSame(DummyCommandHandler::class, $map->handlerFor($message));
    }

    public function test_it_throws_exception_when_handler_is_missing(): void
    {
        $map = new CommandHandlerMap([]);

        $this->expectException(HandlerNotFoundException::class);

        $map->handlerFor(new stdClass);
    }
}

final class DummyCommandMessage {}

final class DummyCommandHandler {}
