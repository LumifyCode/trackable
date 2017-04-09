<?php

namespace Lumify\Trackable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package Lumify\Trackable
 * @copyright (c) LumifyPH <http://lumify.ph>
 */
class HistoryData extends Model
{

    protected $table = 'history_data';
    public $timestamps = false;

    public function history()
    {
        return $this->belongsTo(History::class);
    }

}