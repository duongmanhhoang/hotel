<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'subject', 'email', 'location_id', 'text'];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function userReader()
    {
        return $this->belongsToMany(
            'App\Models\User',
            'contact_readers',
            'contact_id',
            'user_id'
        );
    }
}
