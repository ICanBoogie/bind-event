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

use ICanBoogie\Core;
use ICanBoogie\EventCollection;
use ICanBoogie\EventCollectionProvider;

class HooksTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Core
	 */
	private $app;

	public function setup()
	{
		$this->app = \ICanBoogie\app();
	}

	public function test_config()
	{
		$config = $this->app->configs['event'];

		$this->assertArrayHasKey('Sample\Class\A', $config);
		$this->assertArrayHasKey('Sample\Class\B', $config);
		$this->assertArrayHasKey('Sample\Class\C', $config);
		$this->assertContains('Sample\Hook::function_a', $config['Sample\Class\A']);
		$this->assertContains('Sample\Hook::function_b', $config['Sample\Class\B']);
		$this->assertContains('Sample\Hook::function_c', $config['Sample\Class\C']);
	}

	public function test_events()
	{
		$events = Hooks::get_events($this->app);

		$this->assertSame($events, $this->app->events);
		$this->assertSame($events, EventCollectionProvider::provide());
	}
}
