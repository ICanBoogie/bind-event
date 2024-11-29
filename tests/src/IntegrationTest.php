<?php

namespace Test\ICanBoogie\Binding\Event;

use PHPUnit\Framework\TestCase;
use Test\ICanBoogie\Binding\Event\Acme\SampleEvent;

use function ICanBoogie\emit;

final class IntegrationTest extends TestCase
{
    public function test_event(): void
    {
        $ev = emit(new SampleEvent());

        $this->assertEquals("Hello world!", $ev->result);
    }
}
