<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'unit_id',
        'image',
        'cate_id',
        'name',
        'price',
        'lang_id',
        'lang_parent_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id')->where('type', Category::SERVICE);
    }

    public function langChildren()
    {
        return $this->hasMany($this, 'lang_parent_id');
    }

    public function langParent()
    {
        return $this->belongsTo($this, 'lang_parent_id');
    }
}
