<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'code',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'messages',
        'total',
        'status',
    ];

    public function rooms()
    {
        return $this->belongsToMany(
            Room::class,
            'room_invoice',
            'invoice_code',
            'room_id',
            'code',
            'id'
        )->withPivot('id', 'room_number', 'price', 'check_in_date', 'check_out_date', 'extra', 'currency', 'note', 'status');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'invoice_service');
    }

}
