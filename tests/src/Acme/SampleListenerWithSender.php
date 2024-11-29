<?php

namespace Test\ICanBoogie\Binding\Event\Acme;

final class SampleListenerWithSender
{
    public static function on_event(SampleEventWithSender $event, SampleSender $sender): void
    {
        $event->result = "Hello world!";
    }
}
