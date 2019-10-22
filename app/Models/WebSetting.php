<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
	public $timestamps = false;
    protected $table = 'web_settings';
    protected $fillable = [
    	'logo',
        'logo_footer',
    	'facebook',
    	'twitter',
    	'instagram',
    	'linkedin',
    	'tripadvisor',
        'youtube',
        'google_plus',
        'phone',
        'address',
    ];
}
