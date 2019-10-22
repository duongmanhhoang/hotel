<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $fillable = [
    	'image',
    	'title',
    	'description',
    	'url',
    	'is_active',
    	'order_number'
    ];
}
