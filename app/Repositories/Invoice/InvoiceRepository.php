<?php

namespace App\Repositories\Invoice;

use App\Models\Invoice;
use App\Models\Room;
use App\Models\RoomDetail;
use App\Models\RoomInvoice;
use App\Models\RoomName;
use App\Models\Service;
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
        if (isset($data['services'])) {
            $invoice->services()->attach($data['services']);
        }

        $invoice->rooms()->attach([$data['room_id'] => $dataPivot]);

    }

    protected function makePivotData($data, $isUpdate = false)
    {
        $data['check_in_date'] = Carbon::parse($data['check_in_date'])->toDateTimeString();
        $data['check_out_date'] = Carbon::parse($data['check_out_date'])->toDateTimeString();
        if ($isUpdate) {
            return [
                'room_id' => $data['room_id'],
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

    protected function makeData($data)
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

    public function makeRulesUpdateBefore()
    {
        return [
            'check_in_date' => 'required|after:yesterday',
            'check_out_date' => 'required|after:check_in_date',
            'room_id' => 'required',
            'room_number' => 'required',
            'extra' => 'nullable|numeric',
            'customer_name' => 'required|max:191',
            'customer_email' => 'nullable|email|max:191',
            'customer_phone' => 'required|numeric|digits_between:9,15',
            'customer_address' => 'nullable|max:191',
        ];
    }

    public function messagesUpdateBefore()
    {
        return [
            'check_in_date.required' => 'Vui lòng không bỏ trống',
            'check_in_date.after' => 'Vui lòng chọn từ ngày hôm nay',
            'check_out_date.required' => 'Vui lòng không bỏ trống',
            'check_out_date.after' => 'Vui lòng chọn sau ngày đến',
            'room_id.required' => 'Vui lòng không bỏ trống',
            'room_number.required' => 'Vui lòng không bỏ trống',
            'extra.numeric' => 'Vui lòng chỉ nhập số',
            'customer_name.required' => 'Vui lòng không bỏ trống',
            'customer_name.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
            'customer_email.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
            'customer_email.email' => 'Vui lòng nhập đúng định dạng email',
            'customer_phone.required' => 'Vui lòng không bỏ trống',
            'customer_phone.numeric' => 'Vui lòng chỉ nhập số',
            'customer_phone.digits_between' => 'Vui lòng chỉ nhập trong khoảng từ 9 đến 15 số',
            'customer_address.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
        ];
    }

    public function makeRulesUpdateAfter()
    {
        return [
            'extra' => 'nullable|numeric',
            'customer_name' => 'required|max:191',
            'customer_email' => 'nullable|email|max:191',
            'customer_phone' => 'required|numeric|digits_between:9,15',
            'customer_address' => 'nullable|max:191',
        ];
    }

    public function messagesUpdateAfter()
    {
        return [
            'extra.numeric' => 'Vui lòng chỉ nhập số',
            'customer_name.required' => 'Vui lòng không bỏ trống',
            'customer_name.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
            'customer_email.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
            'customer_email.email' => 'Vui lòng nhập đúng định dạng email',
            'customer_phone.required' => 'Vui lòng không bỏ trống',
            'customer_phone.numeric' => 'Vui lòng chỉ nhập số',
            'customer_phone.digits_between' => 'Vui lòng chỉ nhập trong khoảng từ 9 đến 15 số',
            'customer_address.max' => 'Vui lòng không nhập quá ' . ' :max ' . ' ký tự',
        ];
    }

    public function updateData($data, $invoice, $invoiceRoom, $isAfter)
    {
        if ($isAfter) {
            $data['check_in_date'] = $invoiceRoom->check_in_date;
            $data['check_out_date'] = $invoiceRoom->check_out_date;
            $data['room_number'] = $invoiceRoom->room_number;
            $data['room_id'] = $invoiceRoom->room_id;
        }

        $data['price'] = $this->getRoomPrice($data);
        $data['total'] = $this->getTotal($data);
        $data['code'] = $invoice->code;
        $pivotData = $this->makePivotData($data, true);
        $invoiceData = $this->makeData($data);
        $invoice->update($invoiceData);
        $invoiceRoom->update($pivotData);
        if ($data['services']) {
            $invoice->services()->sync($data['services']);
        }
    }

    public function makeDataTable()
    {
        $invoices = $this->_model->with('rooms', 'rooms.roomName')->orderBy('id', 'desc')->get();
        foreach ($invoices as $invoice) {
            $invoice->checkIn = $invoice->rooms[0]['pivot']->check_in_date;
            $invoice->checkOut = $invoice->rooms[0]['pivot']->check_out_date;
            if (session('locale') == config('common.languages.default')) {
                $name = $invoice->rooms[0]->roomName->name;
            } else {
                $roomName =  $invoice->rooms[0]->roomName;
                $child = RoomName::where('lang_parent_id', $roomName->id)->first();
                if ($child) {
                    $name = $child->name;
                } else {
                    $name = $roomName->name;
                }
            }
            $invoice->room_name = $name;
            $invoice->price = number_format($invoice->rooms[0]['pivot']->price);
            $invoice->currency = $invoice->rooms[0]['pivot']->currency ? '$' : 'vnđ';
            $invoice->room_number = $invoice->rooms[0]['pivot']->room_number;
            $invoice->total = number_format($invoice->total);
            $invoice->status = $invoice->rooms[0]['pivot']->status;
        }

        return $invoices;
    }

    public function checkDataCurrency($roomId, $currency)
    {
        if ($currency == config('common.currency.en')) {
            $roomDetail = RoomDetail::where('lang_id', config('common.languages.english'))->where('lang_parent_id', $roomId)->first();
            if (!$roomDetail) {
                return false;
            }
        }

        return true;
    }

    public function getUsedServices($invoice)
    {
        $invoice->load('services.langChildren');
        $services = $invoice->services;
        foreach ($services as $service) {
            if ($service->lang_id != session('locale')) {
                if ($service->lang_parent_id != 0) {
                    $parent = $service->langParent;
                    $service->id = $parent->id;
                } else {
                    $child = $service->langChildren->where('lang_id', session('locale'))->first();
                    $service->id = $child->id;
                }

            }
        }

        return $services;
    }

    public function getServicesEdit($invoiceRoom)
    {
        $currency = $invoiceRoom->currency;
        $services = Service::with('langParent', 'langChildren')->where('lang_id', session('locale'))->get();
        if ($currency == config('common.currency.vi')) {
            foreach ($services as $service) {
                if ($service->lang_parent_id != 0) {
                    $parent = $service->langParent;
                    $service->price = $parent->price;
                }
            }
        } else {
            foreach ($services as $service) {
                if ($service->lang_parent_id == 0) {
                    $child = $service->langChildren->where('lang_id', config('common.languages.english'))->first();
                    $service->price = $child->price;
                }
            }
        }

        return $services;
    }
}
