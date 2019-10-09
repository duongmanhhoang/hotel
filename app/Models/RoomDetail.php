<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomDetail extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'price',
        'sale_price',
        'short_description',
        'description',
        'lang_id',
        'lang_parent_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
