<?php

namespace App\Repositories\Notification;

use App\Models\Notification;
use App\Models\User;
use App\Repositories\EloquentRepository;

class NotificationRepository extends EloquentRepository
{
    public function getModel()
    {
        return Notification::class;
    }

    public function sendNotiClientBooking($invoice)
    {
        $data = $this->makeDataClientBooking($invoice);
        $this->_model->create($data);
    }

    protected function makeDataClientBooking($invoice)
    {
        $data = [
            'code' => $invoice->code,
            'total' => $invoice->total,
        ];
        $data['type'] = 'invoice_created';
        $data['data'] = json_encode($data);
        $data['notifiable_type'] = User::class;
        $data['notifiable_id'] = $invoice->user_id;

        return $data;
    }
}
