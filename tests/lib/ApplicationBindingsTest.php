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

use ICanBoogie\EventCollection;
use PHPUnit\Framework\TestCase;

use function ICanBoogie\app;

/**
 * @group integration
 */
class ApplicationBindingsTest extends TestCase
{
	public function test_lazy_get_events()
	{
		$app = app();
		$events = $app->events;

		$this->assertInstanceOf(EventCollection::class, $events);
		$this->assertSame($events, $app->events);
	}
}
