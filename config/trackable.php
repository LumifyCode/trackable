<?php

return [
    'observer' => \Lumify\Trackable\Observers\TrackableObserver::class,
    'history_model' => \Lumify\Trackable\Models\History::class,
    'history_data_model' => \Lumify\Trackable\Models\HistoryData::class,
    'history_morph_field' => 'trackable',
    'history_order' => ['created_at', 'DESC'],
    'track_created' => true,
    'track_updated' => true,
    'track_deleted' => true,
    'track_restored' => true,
];
