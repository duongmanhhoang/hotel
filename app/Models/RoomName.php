<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomName extends Model
{
    protected $fillable = [
        'name',
        'lang_id',
        'lang_parent_id',
    ];

    public function roomNames()
    {
        return $this->hasMany($this, 'lang_parent_id');
    }
}
