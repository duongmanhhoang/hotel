<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    protected $fillable = [
        'time',
        'day',
        'month',
        'year',
        'incoming',
        'outgoing',
        'location_id',
        'room_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
