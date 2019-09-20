<?php

namespace Spatie\EventSourcing\Exceptions;

use Exception;
use Spatie\EventSourcing\ShouldBeStored;

final class InvalidEventHandler extends Exception
{
    public static function eventHandlingMethodDoesNotExist(object $eventHandler, ShouldBeStored $event, string $methodName): self
    {
        $eventHandlerClass = get_class($eventHandler);
        $eventClass = get_class($event);

        return new static("Tried to call `$methodName` on `$eventHandlerClass` to handle an event of class `$eventClass` but that method does not exist.");
    }

    public static function doesNotExist(string $eventHandlerClass)
    {
        return new static("The event handler class `{$eventHandlerClass}` does not exist.");
    }

    public static function notAProjector(object $object)
    {
        return new static('`'.get_class($object).'` must implement Spatie\EventProcjetor\Projectors\Projector');
    }

    public static function notAnEventHandler(object $object)
    {
        return new static('`'.get_class($object).'` must implement Spatie\EventSourcing\EventHandlers\EventHandler');
    }

    public static function notAnEventHandlingClassName(string $className)
    {
        return new static('`'.$className.'` must implement Spatie\EventSourcing\EventHandlers\EventHandler');
    }
}
