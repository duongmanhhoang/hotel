<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'location_id',
        'image',
        'sale_status',
        'sale_start_at',
        'sale_end_at',
        'rating',
        'adults',
        'children',
    ];

    public function listRoomNumbers()
    {
        return $this->hasMany(ListRoomNumber::class, 'room_id');
    }

    public function roomDetails()
    {
        return $this->hasMany(RoomDetail::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'room_property');
    }
}
