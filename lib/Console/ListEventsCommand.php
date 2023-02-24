<?php

namespace ICanBoogie\Binding\Event\Console;

use ICanBoogie\Console\CallableDisplayName;
use ICanBoogie\Event\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ListEventsCommand extends Command
{
    protected static $defaultDescription = "List event listeners";

    public function __construct(
        private readonly Config $config,
        private readonly string $style,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $rows = [];

        foreach ($this->config->listeners as $event => $callbacks) {
            foreach ($callbacks as $callback) {
                $rows[] = [
                    $event,
                    CallableDisplayName::from($callback)
                ];
            }
        }

        $table = new Table($output);
        $table->setHeaders([ 'Event', 'Callback' ]);
        $table->setRows($rows);
        $table->setStyle($this->style);
        $table->render();

        return Command::SUCCESS;
    }
}
