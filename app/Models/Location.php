<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'province_id',
        'lang_id',
        'lang_parent_id',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class, 'lang_parent_id');
    }
}
