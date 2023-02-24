<?php

/*
 * This file is part of the ICanBoogie package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Test\ICanBoogie\Binding\Event;

use ICanBoogie\Application;
use ICanBoogie\Binding\Event\Hooks;
use ICanBoogie\EventCollectionProvider;
use PHPUnit\Framework\TestCase;

use function ICanBoogie\app;
use function ICanBoogie\emit;

/**
 * @group integration
 */
final class HooksTest extends TestCase
{
    private Application $app;

    protected function setup(): void
    {
        $this->app = app();
    }

    public function test_emit()
    {
        $event = emit(new SampleEvent());

        $this->assertEquals("Hello world!", $event->result);
    }

    public function test_events()
    {
        $events = Hooks::get_events($this->app);

        $this->assertSame($events, $this->app->events);
        $this->assertSame($events, EventCollectionProvider::provide());
    }
}
