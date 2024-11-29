<?php

namespace Test\ICanBoogie\Binding\Event;

use ICanBoogie\Event\Config;
use PHPUnit\Framework\TestCase;
use Test\ICanBoogie\Binding\Event\Acme\SampleEvent;
use Test\ICanBoogie\Binding\Event\Acme\SampleEventWithSender;
use Test\ICanBoogie\Binding\Event\Acme\SampleSender;

use function ICanBoogie\app;

final class ConfigTest extends TestCase
{
    public function test_config(): void
    {
        $config = app()->config_for_class(Config::class);
        $listeners = $config->listeners;

        $expected_event_1 = SampleEvent::class;
        $expected_event_2 = SampleEventWithSender::for(SampleSender::class);

        $this->assertArrayHasKey($expected_event_1, $listeners);
        $this->assertArrayHasKey($expected_event_2, $listeners);
    }
}
