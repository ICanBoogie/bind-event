<?php

namespace Test\ICanBoogie\Binding\Event\Console;

use ICanBoogie\Binding\Event\Console\ListEventsCommand;
use ICanBoogie\Console\Test\CommandTestCase;

final class ListEventsCommandTest extends CommandTestCase
{
	public static function provideExecute(): array
	{
		return [

			[
				'events',
				ListEventsCommand::class,
				[],
				[
					'Test\ICanBoogie\Binding\Event\SampleEvent',
					'Test\ICanBoogie\Binding\Event\SampleListener::on_event'
				]
			],

		];
	}

	public function testAlias(): void
	{
		$loader = $this->getCommandLoader();
		$command1 = $loader->get('events');
		$command2 = $loader->get('events:list');

		$this->assertSame($command1, $command2);
	}
}
