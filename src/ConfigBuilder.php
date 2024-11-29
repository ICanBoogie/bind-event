<?php

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

    private Event\ConfigBuilder $inner_builder;

    public function __construct()
    {
        $this->inner_builder = new Event\ConfigBuilder();
    }

    public function build(): Config
    {
        return $this->inner_builder->build();
    }

    /**
     * @uses Event\ConfigBuilder::attach()
     *
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
     * @uses Event\ConfigBuilder::attach_to()
     *
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

    /**
     * Searches for listeners annotated with the {@see \ICanBoogie\Event\Listener} attribute.
     *
     * @uses Event\ConfigBuilder::use_attributes()
     *
     * @return $this
     */
    public function use_attributes(): self
    {
        $this->inner_builder->use_attributes();

        return $this;
    }
}
