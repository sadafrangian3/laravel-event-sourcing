<?php

namespace Spatie\EventProjector\Events;

use Illuminate\Support\Collection;

class StartingEventReplay
{
    /** @var \Illuminate\Support\Collection */
    protected $projectors;

    public function __construct(Collection $projectors)
    {
        $this->projectors = $projectors;
    }
}
