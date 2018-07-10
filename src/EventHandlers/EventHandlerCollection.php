<?php

namespace Spatie\EventProjector\EventHandlers;

use Exception;
use Illuminate\Support\Collection;
use Spatie\EventProjector\EventHandlers\EventHandler;
use Spatie\EventProjector\Events\EventHandlerFailedHandlingEvent;
use Spatie\EventProjector\Exceptions\InvalidEventHandler;
use Spatie\EventProjector\Models\StoredEvent;

class EventHandlerCollection
{
    /** @var \Illuminate\Support\Collection */
    protected $eventHandlers;

    public function __construct()
    {
        $this->eventHandlers = collect();
    }

    public function add(EventHandler $eventHandler)
    {
        $className = get_class($eventHandler);

        if (! $this->eventHandlers->has($className)) {
            $this->eventHandlers[$className] = $eventHandler;
        }
    }

    public function all(): Collection
    {
        return $this->eventHandlers;
    }

    public function forEvent(StoredEvent $storedEvent): Collection
    {
        return $this->eventHandlers->filter(function (EventHandler $eventHandler) use ($storedEvent) {
            return $eventHandler->handles()->contains($storedEvent->event_class);
        });
    }

    public function call(string $method)
    {
        $this->eventHandlers
            ->filter(function (EventHandler $eventHandler) use ($method) {
                return method_exists($eventHandler, $method);
            })
            ->each(function (EventHandler $eventHandler) use ($method) {
                return app()->call([$eventHandler, $method]);
            });
    }

    protected function alreadyAdded(EventHandler $eventHandler): bool
    {
        $eventHandlerClassName = get_class($eventHandler);

        return $this->eventHandlers->has($eventHandlerClassName);
    }
}
