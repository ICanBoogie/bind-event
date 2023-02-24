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

use ICanBoogie\Config\Builder;
use ICanBoogie\Event;
use ICanBoogie\Event\Config;

/**
 * @implements Builder<Config>
 */
final class ConfigBuilder implements Builder
{
    public static function get_fragment_filename(): string
    {
        return 'event';
    }

    private readonly Event\ConfigBuilder $inner_builder;

    public function __construct()
    {
        $this->inner_builder = new Event\ConfigBuilder();
    }

    public function build(): Config
    {
        return $this->inner_builder->build();
    }

    /**
     * @param class-string<Event> $event_class
     * @param callable $listener
     *
     * @return $this
     */
    public function attach(string $event_class, callable $listener): self
    {
        $this->inner_builder->attach($event_class, $listener);

        return $this;
    }

    /**
     * @param class-string $sender_class
     * @param class-string<Event> $event_class
     * @param callable $listener
     *
     * @return $this
     */
    public function attach_to(string $sender_class, string $event_class, callable $listener): self
    {
        $this->inner_builder->attach_to($sender_class, $event_class, $listener);

        return $this;
    }
}
