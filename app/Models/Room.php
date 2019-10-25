<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_name_id',
        'location_id',
        'image',
        'sale_status',
        'sale_start_at',
        'sale_end_at',
        'rating',
        'adults',
        'children',
        'available_time',
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

    public function roomName()
    {
        return $this->belongsTo(RoomName::class, 'room_name_id');
    }
}
