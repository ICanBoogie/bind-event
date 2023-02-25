<?php

namespace ICanBoogie\Binding\Event;

use Test\ICanBoogie\Binding\Event\Acme\SampleEvent;
use Test\ICanBoogie\Binding\Event\Acme\SampleEventWithSender;
use Test\ICanBoogie\Binding\Event\Acme\SampleListener;
use Test\ICanBoogie\Binding\Event\Acme\SampleListenerWithSender;
use Test\ICanBoogie\Binding\Event\Acme\SampleSender;

return fn(ConfigBuilder $config) => $config
    ->attach(SampleEvent::class, [ SampleListener::class, 'on_event' ])
    ->attach_to(SampleSender::class, SampleEventWithSender::class, [ SampleListenerWithSender::class, 'on_event' ]);
