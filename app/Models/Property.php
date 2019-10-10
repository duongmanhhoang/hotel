<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'name',
        'lang_id',
        'lang_parent_id'
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_property');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'lang_parent_id');
    }
}
