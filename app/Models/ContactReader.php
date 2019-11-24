<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactReader extends Model
{
    protected $table = 'contact_readers';

    protected $fillable = ['contact_id', 'user_id'];

    public $timestamps = false;

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
