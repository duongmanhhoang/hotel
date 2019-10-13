<?php

namespace App\Repositories\Invoice;

use App\Models\Invoice;
use App\Models\Room;
use App\Models\RoomInvoice;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use http\Env\Request;

class InvoiceRepository extends EloquentRepository
{
    public function getModel()
    {
        return Invoice::class;
    }

    public function getAll($keyword)
    {
        $invoices = $this
            ->_model
            ->where('code', 'like', '%'. $keyword . '%')
            ->orWhere('customer_name', 'like', '%'. $keyword . '%')
            ->orWhere('customer_phone', 'like', '%'. $keyword . '%')
            ->orWhere('customer_email', 'like', '%'. $keyword . '%')
            ->orWhere('customer_address', 'like', '%'. $keyword . '%')
            ->with('rooms')
            ->paginate(config('common.pagination.default'));

        return $invoices;
    }

    public function storeData($data)
    {
        $data['code'] = uniqid();
        $data['price'] = $this->getRoomPrice($data);
        $data['total'] = $this->getTotal($data);
        $dataPivot = $this->makePivotData($data);
        $dataInvoice = $this->makeData($data);
        $invoice = $this->_model->create($dataInvoice);
        $invoice->rooms()->attach([$data['room_id'] => $dataPivot]);

    }

    public function makePivotData($data)
    {
        $data['check_in_date'] = Carbon::parse($data['check_in_date'])->toDateTimeString();
        $data['check_out_date'] = Carbon::parse($data['check_out_date'])->toDateTimeString();

        return [
            'room_number' => $data['room_number'],
            'price' => $data['price'],
            'note' => $data['note'],
            'status' => $data['status'],
            'check_in_date' => $data['check_in_date'],
            'check_out_date' => $data['check_out_date'],
            'currency' => $data['currency'],
            'extra' => $data['extra']
        ];
    }

    public function makeData($data)
    {
        return [
            'code' => $data['code'],
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'total' => $data['total'],
            'customer_email' => $data['customer_email'],
            'customer_address' => $data['customer_address'],
            'messages' => $data['messages'],
        ];
    }

    public function getRoomPrice($data)
    {
        $room = Room::find($data['room_id']);
        if (!$data['currency']) {
            if ($room->sale_status) {
                return $room->roomDetails()->where('lang_parent_id', 0)->first()->sale_price;
            }

            return $room->roomDetails()->where('lang_parent_id', 0)->first()->price;
        } else {
            if ($room->sale_status) {
                return $room->roomDetails()->where('lang_parent_id', '<>', 0)->first()->sale_price;
            }

            return $room->roomDetails()->where('lang_parent_id', '<>', 0)->first()->price;
        }
    }

    public function getTotal($data)
    {
        $checkIn = Carbon::parse($data['check_in_date']);
        $checkOut = Carbon::parse($data['check_out_date']);
        $days = $checkOut->diff($checkIn)->days;
        $total = ($data['price'] * $days) + $data['extra'];

        return $total;
    }

    public function getAvailableRoom($request)
    {
        $checkIn = Carbon::parse($request->checkIn)->toDateString();
        $checkOut = Carbon::parse($request->checkOut)->toDateString();

        $roomInvoices = RoomInvoice::whereIn('status', [RoomInvoice::NOT_PAY, RoomInvoice::PAID])->get();
        dd($roomInvoices);

    }
}
