<?php

namespace Lumify\Trackable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * 
 * @property integer    $id
 * @property string     $event
 * @property \Illuminate\Database\Eloquent\Relations\MorphTo     trackable
 * @property \Illuminate\Database\Eloquent\Relations\MorphTo     causer
 * @property datetime   $created_at
 * @property datetime   $updated_at
 * @property datetime   $deleted_at
 * 
 * @package Lumify\Trackable
 * @copyright (c) LumifyPH <http://lumify.ph>
 */
class History extends Model
{

    protected $table = 'history';

    public function trackable()
    {
        return $this->morphTo()->withTrashed();
    }

    public function causer()
    {
        return $this->morphTo()->withTrashed();
    }

    public function data()
    {
        return $this->hasMany(HistoryData::class);
    }

}