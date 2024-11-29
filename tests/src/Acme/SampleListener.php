<?php

namespace Test\ICanBoogie\Binding\Event\Acme;

final class SampleListener
{
    public static function on_event(SampleEvent $event): void
    {
        $event->result = "Hello world!";
    }
}
