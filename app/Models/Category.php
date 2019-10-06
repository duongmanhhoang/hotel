<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['id', 'name', 'parent_id', 'lang_id', 'lang_parent_id', 'created_at', 'updated_at'];

    public function language()
    {
        return $this->belongsTo('App\Models\Language', 'lang_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany('App\Model\Post');
    }

    public function parent()
    {
        return $this->belongsTo($this);
    }
}
