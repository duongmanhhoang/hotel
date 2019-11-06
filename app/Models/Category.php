<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const POST = 0;
    const SERVICE = 1;

    protected $table = 'categories';

    protected $fillable = ['id', 'name', 'parent_id', 'lang_id', 'lang_parent_id', 'created_at', 'updated_at', 'type'];

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
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function parentTranslate()
    {
        return $this->belongsTo($this, 'lang_parent_id');
    }

    public function childrenTranslate()
    {
        return $this->hasMany($this, 'lang_parent_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'cate_id');
    }
}
