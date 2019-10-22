<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    const INCOMING = 1;
    const OUTGOING = 2;

    protected $fillable = [
        'title',
        'body',
        'type',
        'money',
        'location_id',
        'room_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
