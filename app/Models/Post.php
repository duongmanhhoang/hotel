<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['id', 'category_id', 'title', 'description', 'body', 'lang_id', 'lang_parent_id'];

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
