<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'email',
        'body',
        'rating'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}
