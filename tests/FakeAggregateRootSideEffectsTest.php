<?php

namespace Spatie\EventSourcing\Tests;

use function PHPUnit\Framework\assertFalse;

use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Spatie\EventSourcing\Projectionist;
use Spatie\EventSourcing\Tests\TestClasses\AggregateRoots\DummyAggregateRoot;
use Spatie\EventSourcing\Tests\TestClasses\AggregateRoots\StorableEvents\DummyEvent;

beforeAll(function () {
    class FakeAggregateRootSideEffectsProjector extends Projector
    {
        public static $triggered = false;

        public static function clear(): void
        {
            self::$triggered = false;
        }

        public function on(DummyEvent $dummyEvent): void
        {
            self::$triggered = true;
        }
    }
});

it('will apply the given events', function () {
    $projectionist = app(Projectionist::class);

    $projectionist->addProjector(FakeAggregateRootSideEffectsProjector::class);

    DummyAggregateRoot::fake()
        ->given([
            new DummyEvent(123),
        ]);

    assertFalse(FakeAggregateRootSideEffectsProjector::$triggered);
});
