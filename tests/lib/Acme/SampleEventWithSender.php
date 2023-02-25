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

use ICanBoogie\Event;

class SampleEventWithSender extends Event
{
    public string $result;

    public function __construct(SampleSender $sender)
    {
        parent::__construct($sender);
    }
}
