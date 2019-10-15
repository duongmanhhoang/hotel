<?php

namespace App\Repositories\InvoiceRoom;

use App\Models\RoomInvoice;
use App\Repositories\EloquentRepository;

class InvoiceRoomRepository extends EloquentRepository
{
    public function getModel()
    {
        return RoomInvoice::class;
    }
}
