<?php

namespace Lumify\Trackable\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * @package Lumify\Trackable
 * @copyright (c) LumifyPH <http://lumify.ph>
 */
trait Trackable
{

    public static function bootTrackable()
    {
        static::observe(static::observerClass());
    }

    public static function observerClass()
    {
        return config('trackable.observer');
    }

    public function causerObject()
    {
        return Auth::user();
    }

    public function history()
    {
        return $this->morphMany($this->historyModelClass(), $this->historyMorphField())->orderBy($this->historyOrder()[0],
                        $this->historyOrder()[1]);
    }

    public function historyModelClass()
    {
        return config('trackable.history_model');
    }

    public function historyDataModelClass()
    {
        return config('trackable.history_data_model');
    }

    public function historyMorphField()
    {
        return config('trackable.history_morph_field');
    }

    public function historyOrder()
    {
        return config('trackable.history_order');
    }

    public function trackCreated()
    {
        return config('trackable.track_created');
    }

    public function trackUpdated()
    {
        return config('trackable.track_updated');
    }

    public function trackDeleted()
    {
        return config('trackable.track_deleted');
    }

    public function trackRestored()
    {
        return config('trackable.track_restored');
    }

    public function fieldNameMap()
    {
        return [];
    }

    public function display($field, $value)
    {
        $methodName = 'display' . studly_case($field);
        if (method_exists($this, $methodName)) {
            return call_user_func([$this, $methodName], $value);
        }
        return $value;
    }

    public function formatField($field)
    {
        $fieldDisplayMap = $this->fieldNameMap();
        if (count($fieldDisplayMap) > 0 && isset($fieldDisplayMap[$field])) {
            return $fieldDisplayMap[$field];
        }
        return $field;
    }

}