<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomInvoice extends Model
{
    const NOT_PAY = 0;
    const PAID = 1;
    const PAID_SOON = 2;
    const PAID_LATE = 3;

    protected $table = 'room_invoice';
}
