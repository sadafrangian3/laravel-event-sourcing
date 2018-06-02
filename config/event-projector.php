<?php

return [

    /*
     * A queue is need to guarantee that all events get passed to the projectors in
     * the right order. Here you can set of the name of the queue. In production
     * environments you must use a real queue and not the sync driver.
     */
    'queue' => env('EVENT_PROJECTOR_QUEUE_DRIVER', 'sync'),

    /*
     * This class is responsible for storing events. To add extra behavour you
     * can change this to a class of your own. The only restriction is that
     * it should extend \Spatie\EventProjector\Models\StoredEvent.
     */
    'stored_event_model' => \Spatie\EventProjector\Models\StoredEvent::class,

    /*
     * This class is responsible for projector statuses. To add extra behavour you
     * can change this to a class of your own. The only restriction is that
     * it should extend \Spatie\EventProjector\Models\ProjectorStatus.
     */
    'projector_status_model' => \Spatie\EventProjector\Models\ProjectorStatus::class,

    /*
     * This class is responsible for serializing events. By default an event will be serialized
     * and stored as json. You can customize the class name. A valid serializer
     * should implement Spatie\EventProjector\EventSerializers\Serializer.
     */
    'event_serializer' => \Spatie\EventProjector\EventSerializers\JsonEventSerializer::class,

    /*
     * When replaying events potentially a lot of events will have to be retrieved.
     * In order to avoid memory problems events will be retrieved in
     * a chuncked way. You can specify the chunk size here.
     */
    'replay_chunk_size' => 1000,

    /*
     * A list of projector classes that should be automatically registered.
     */
    'projectors' => [],

    /*
     * A list of reactor classes that should be automatically registered.
     */
    'reactors' => [],

    /*
     * The diskname where the snapshots are stored. You can create a disk in the
     * default Laravel filesystems.php config file.
     */
    'snapshots_disk' => 'local',
];
