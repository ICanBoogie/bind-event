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

use ICanBoogie\Application;
use ICanBoogie\Event\Config;
use ICanBoogie\EventCollection;
use ICanBoogie\EventCollectionProvider;

final class Hooks
{
	static public function get_events(Application $app): EventCollection
	{
		static $events;

		return $events ??= self::make_events($app);
	}

	static private function make_events(Application $app): EventCollection
	{
		$events = new EventCollection($app->configs[Config::class]);

		EventCollectionProvider::define(fn(): EventCollection => $events);

		return $events;
	}
}
