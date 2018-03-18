<?php

/*
 * This file is part of the ICanBoogie package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ICanBoogie\Binding\Event;

use function ICanBoogie\app;
use ICanBoogie\EventCollection;

/**
 * @group integration
 */
class ApplicationBindingsTest extends \PHPUnit\Framework\TestCase
{
	public function test_lazy_get_events()
	{
		$app = app();
		$events = $app->events;

		$this->assertInstanceOf(EventCollection::class, $events);
		$this->assertSame($events, $app->events);
	}
}
