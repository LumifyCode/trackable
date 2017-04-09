<?php

namespace Lumify\Trackable\Observers;

/**
 * @package Lumify\Trackable
 * @copyright (c) LumifyPH <http://lumify.ph>
 */
class TrackableObserver
{

    public function created($trackable)
    {
        if ($trackable->trackCreated() === false) {
            return;
        }
        $historyModelClass = $trackable->historyModelClass();
        $history = new $historyModelClass;
        $history->event = 'created';
        $history->causer()->associate($trackable->causerObject());
        $history->trackable()->associate($trackable);
        $history->save();
    }

    public function updated($trackable)
    {
        if ($trackable->trackUpdated() === false) {
            return;
        }
        $historyModelClass = $trackable->historyModelClass();
        $historyDataModelClass = $trackable->historyDataModelClass();
        $history = new $historyModelClass;
        $history->event = 'updated';
        $history->causer()->associate($trackable->causerObject());
        $history->trackable()->associate($trackable);
        $history->save();

        $old = $trackable->getOriginal();
        $new = $trackable->getAttributes();
        foreach ($old as $field => $oldValue) {
            if ($field == 'updated_at' || $field == 'deleted_at') {
                //do not include updated_at and deleted_at during updates
                continue;
            }
            //only save updated attributes
            if ($new[$field] != $oldValue) {

                $historyData = new $historyDataModelClass;
                $historyData->history_id = $history->id;
                $historyData->field = $field;
                $historyData->new_value = $new[$field];
                $historyData->old_value = $oldValue;
                $historyData->save();
            }
        }
    }

    public function deleted($trackable)
    {
        if ($trackable->trackDeleted() === false) {
            return;
        }
        $historyModelClass = $trackable->historyModelClass();
        $history = new $historyModelClass;
        $history->event = 'deleted';
        $history->causer()->associate($trackable->causerObject());
        $history->trackable()->associate($trackable);
        $history->save();
    }

    public function restored($trackable)
    {
        if ($trackable->trackRestored() === false) {
            return;
        }
        $historyModelClass = $trackable->historyModelClass();
        $history = new $historyModelClass;
        $history->event = 'restored';
        $history->causer()->associate($trackable->causerObject());
        $history->trackable()->associate($trackable);
        $history->save();
    }

}