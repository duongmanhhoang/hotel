<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
	public $timestamps = false;
    protected $table = 'web_settings';
    protected $fillable = [
    	'logo',
    	'facebook',
    	'twitter',
    	'instagram',
    	'linkedin',
    	'tripadvisor',
    ];
}
