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

class EventConfigSynthesizer
{
	/**
	 * Synthesizes a configuration suitable to create {@link EventCollection} instances, from
	 * "event" config fragments.
	 *
	 * @param array $fragments Configuration fragments.
	 *
	 * @throws \InvalidArgumentException in attempt to specify an invalid event callback.
	 *
	 * @return array
	 */
	static public function synthesize(array $fragments): array
	{
		$events = [];

		foreach ($fragments as $pathname => $fragment)
		{
			foreach ($fragment as $type => $callback)
			{
				#
				# because modules are ordered by weight (most important are first), we can
				# push callbacks instead of unshifting them.
				#

				$events[$type][] = $callback;
			}
		}

		return $events;
	}
}
