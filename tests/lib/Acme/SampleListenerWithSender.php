<?php

/*
 * This file is part of the ICanBoogie package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Test\ICanBoogie\Binding\Event\Acme;

final class SampleListenerWithSender
{
    public static function on_event(SampleEventWithSender $event, SampleSender $sender): void
    {
        $event->result = "Hello world!";
    }
}
