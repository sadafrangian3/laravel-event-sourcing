<?php

namespace Spatie\EventProjector\Tests\TestClasses\Projectors;

use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\StoredEventRepository;
use Spatie\EventProjector\Models\StoredEvent;
use Spatie\EventProjector\Projectors\ProjectsEvents;
use Spatie\EventProjector\Tests\TestClasses\Events\MoneyAddedEvent;

final class ProjectorThatWritesMetaData implements Projector
{
    use ProjectsEvents;

    protected $handlesEvents = [
        MoneyAddedEvent::class => 'onMoneyAdded',
    ];

    protected $trackStream = '*';

    public function onMoneyAdded(StoredEvent $storedEventData, MoneyAddedEvent $event)
    {
        $storedEventData->meta_data['user_id'] = 1;

        $repository = app(StoredEventRepository::class);
        $repository->update($storedEventData);
    }
}
