<?php

namespace Test\ICanBoogie\Binding\Event\Acme;

use ICanBoogie\Event;

class SampleEventWithSender extends Event
{
    public string $result;

    public function __construct(SampleSender $sender)
    {
        parent::__construct($sender);
    }
}
