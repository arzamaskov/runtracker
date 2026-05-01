<?php

declare(strict_types=1);

namespace Tests\Unit\Bus;

use App\Bus\CommandHandlerMap;
use App\Bus\InMemoryCommandBus;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

class InMemoryCommandBusTest extends TestCase
{
    /**
     * @throws BindingResolutionException
     */
    public function test_it_dispatches_command_to_mapped_handler(): void
    {
        $command = new InMemoryDummyCommand;

        $bus = new InMemoryCommandBus(
            new CommandHandlerMap([
                InMemoryDummyCommand::class => InMemoryDummyCommandHandler::class,
            ]),
            $this->app,
        );

        $this->assertSame('handled', $bus->dispatch($command));
    }
}

final class InMemoryDummyCommand {}

final class InMemoryDummyCommandHandler
{
    public function __invoke(InMemoryDummyCommand $command): string
    {
        return 'handled';
    }
}
