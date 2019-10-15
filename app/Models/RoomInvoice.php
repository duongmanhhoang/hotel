<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomInvoice extends Model
{
    const NOT_PAY = 0;
    const PAID = 1; // Thanh toán nhưng chưa nhận phòng
    const PAID_SOON = 2; // Thanh toán và trả phòng sớm
    const PAID_LATE = 3; // Thanh toán và trả phòng muộn
    const PAID_AND_RETURN = 4; // Thanh toán nhưng đã trả phòng
    const CANCEL = 5; //Hủy

    protected $table = 'room_invoice';

    protected $fillable = [
        'room_id',
        'invoice_code',
        'room_number',
        'price',
        'extra',
        'note',
        'check_in_date',
        'check_out_date',
        'currency',
        'status',
    ];
}
