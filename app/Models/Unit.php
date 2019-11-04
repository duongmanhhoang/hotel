<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'lang_id',
        'lang_parent_id',
    ];

    public function langParent()
    {
        return $this->belongsTo($this, 'lang_parent_id');
    }

    public function langChildren()
    {
        return $this->hasMany($this, 'lang_parent_id');
    }
}
