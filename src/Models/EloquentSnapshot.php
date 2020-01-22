<?php

namespace Spatie\EventSourcing\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\EventSourcing\Snapshot;

class EloquentSnapshot extends Model
{
    public $guarded = [];

    public $timestamps = false;

    protected $table = 'snapshots';

    public $casts = [
        'state' => 'array',
    ];

    public function toSnapshot(): Snapshot
    {
        return new Snapshot($this->aggregate_uuid, $this->aggregate_version, $this->state);
    }

    public function scopeUuid(Builder $query, string $uuid): void
    {
        $query->where('aggregate_uuid', $uuid);
    }
}
