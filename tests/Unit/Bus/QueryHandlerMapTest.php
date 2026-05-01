<?php

declare(strict_types=1);

namespace Tests\Unit\Bus;

use App\Bus\Exception\HandlerNotFoundException;
use App\Bus\QueryHandlerMap;
use PHPUnit\Framework\TestCase;
use stdClass;

class QueryHandlerMapTest extends TestCase
{
    public function test_it_returns_handler_for_message(): void
    {
        $message = new DummyQueryMessage;

        $map = new QueryHandlerMap([
            DummyQueryMessage::class => DummyQueryHandler::class,
        ]);

        $this->assertSame(DummyQueryHandler::class, $map->handlerFor($message));
    }

    public function test_it_throws_exception_when_handler_is_missing(): void
    {
        $map = new QueryHandlerMap([]);

        $this->expectException(HandlerNotFoundException::class);

        $map->handlerFor(new stdClass);
    }
}

final class DummyQueryMessage {}

final class DummyQueryHandler {}
