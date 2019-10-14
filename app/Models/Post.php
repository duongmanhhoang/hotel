<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['id', 'category_id', 'title', 'description', 'body', 'lang_id', 'lang_parent_id', 'image', 'posted_by', 'approve_by', 'approve'];

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function childrenPost()
    {
        return $this->hasMany($this, 'lang_parent_id');
    }

    public function postedBy()
    {
        return $this->belongsTo('App\Models\User', 'posted_by');
    }

    public function approveBy()
    {
        return $this->belongsTo('App\Models\User', 'approve_by');
    }
}
