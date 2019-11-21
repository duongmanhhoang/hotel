<?php

namespace App\Repositories\Room;

use App\Models\ListRoomNumber;
use App\Models\Location;
use App\Models\Room;
use App\Models\RoomDetail;
use App\Models\RoomInvoice;
use App\Models\RoomName;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomRepository extends EloquentRepository
{
    public function getModel()
    {
        return Room::class;
    }

    public function storeRoom($data, $location_id)
    {
        $list_room_numbers = array_unique($data['room_number']);
        $dataRoom = $this->makeRoomData($data, $location_id);
        $dataRoomDetail = $this->makeRoomDetailData($data);
        if ($data['sale_price'] != null && $data['sale_start_at'] == null && $data['sale_end_at'] == null) {
            $dataRoom['sale_status'] = 1;
        } else {
            $dataRoom['sale_status'] = 0;
        }
        $dataListRoom = [];
        $room = $this->create($dataRoom);
        foreach ($list_room_numbers as $key => $room_number) {
            $dataListRoom[$key] = [
                'room_number' => $room_number,
                'room_id' => $room->id,
            ];
        }
        ListRoomNumber::insert($dataListRoom);
        $dataRoomDetail['room_id'] = $room->id;
        RoomDetail::create($dataRoomDetail);

        return true;
    }

    public function updateRoom($data, $room, $roomDetail)
    {
        $dataRoom = $this->makeRoomDataUpdate($data);
        if (isset($data['room_number'])) {
            $dataListRoom = [];
            foreach ($data['room_number'] as $key => $room_number) {
                $dataListRoom[$key] = [
                    'room_number' => $room_number,
                    'room_id' => $room->id,
                ];
            }
            ListRoomNumber::insert($dataListRoom);
        }
        if (isset($data['image'])) {
            $dataRoom = array_merge($dataRoom, ['image' => $data['image']]);
        }
        $dataRoomDetail = $this->makeRoomDetailUpdate($data);
        $room->update($dataRoom);
        $roomDetail->update($dataRoomDetail);
    }

    public function makeRoomDataUpdate($data)
    {
        return [
            'room_name_id' => $data['room_name_id'],
            'sale_start_at' => $data['sale_start_at'],
            'sale_end_at' => $data['sale_end_at'],
            'adults' => $data['adults'],
            'children' => $data['children'],
        ];
    }

    public function makeRoomDetailUpdate($data)
    {
        return [
            'price' => $data['price'],
            'sale_price' => $data['sale_price'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
        ];
    }

    public function makeRoomData($data, $location_id)
    {
        $dataRoom = [
            'room_name_id' => $data['room_name_id'],
            'location_id' => $location_id,
            'sale_start_at' => $data['sale_start_at'],
            'sale_end_at' => $data['sale_end_at'],
            'rating' => 5,
            'adults' => $data['adults'],
            'children' => $data['children'],
            'image' => $data['image'],
        ];

        return $dataRoom;
    }

    public function makeRoomDetailData($data)
    {
        $dataRoomDetail = [
            'price' => $data['price'],
            'sale_price' => $data['sale_price'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
            'lang_id' => config('common.languages.default'),
            'lang_parent_id' => 0,
        ];

        return $dataRoomDetail;
    }

    public function checkLastRoomNumber($room)
    {
        $count = $room->listRoomNumbers->count();
        if ($count == 1) {
            return true;
        }

        return false;
    }

    public function deleteRoomNumber($roomNumbers, $room_number, $roomId)
    {
        $check = $this->checkInvoiceRoomNumber($room_number, $roomId);
        if ($check) {
            foreach ($roomNumbers as $roomNumber) {
                if ($roomNumber->room_number == $room_number) {
                    $number = ListRoomNumber::find($roomNumber->id);
                    $number->delete();

                    return true;
                }
            }
        }

        return false;
    }

    protected function checkInvoiceRoomNumber($roomNumber, $roomId)
    {
        $invoicesCount = RoomInvoice::where('room_id', $roomId)->where('room_number', $roomNumber)->whereIn('status', [RoomInvoice::PAID, RoomInvoice::NOT_PAY])->count();
        if ($invoicesCount == 0) {
            return true;
        };

        return false;
    }

    protected function getRooms($data, $rooms)
    {
        if ($data) {
            foreach ($data as $item) {
                if ($rooms) {
                    if (isset($rooms[$item->room_id])) {
                        array_push($rooms[$item->room_id], $item->room_number);
                        $rooms[$item->room_id] = array_unique($rooms[$item->room_id]);
                    } else {
                        $rooms[$item->room_id] = [$item->room_number];
                    }
                } else {
                    $rooms[$item->room_id] = [$item->room_number];
                }

            }
        };

        return $rooms;
    }

    public function roomAvailable($request)
    {
        $checkDateCheckIn = $this->checkDate($request, true, false);
        $checkDateCheckOut = $this->checkDate($request, false, false);
        $checkDateOver = $this->checkDate($request, true, true);
        $rooms = [];
        $rooms = $this->getRooms($checkDateCheckIn, $rooms);
        $rooms = $this->getRooms($checkDateCheckOut, $rooms);
        $rooms = $this->getRooms($checkDateOver, $rooms);
        $roomIdSearched = array_keys($rooms);
        $roomNotSearched = Room::whereNotIn('id', $roomIdSearched)->get();
        foreach ($roomNotSearched as $item) {
            $rooms[$item->id] = [];
        }
        $roomAvailables = [];
        foreach ($rooms as $key => $item) {
            $room = $this->_model->find($key);
            $listRoomNumbers = $room->listRoomNumbers->whereNotIn('room_number', $item)->pluck('room_number')->toArray();
            if ($listRoomNumbers) {
                if ($roomAvailables) {
                    $arr_push = array(
                        'room_id' => $room->id,
                        'room_number' => $item
                    );
                    array_push($roomAvailables, $arr_push);
                } else {
                    $roomAvailables = array(
                        array(
                            'room_id' => $key,
                            'room_number' => $item,
                        ),
                    );
                }
            }
        }
        if (sizeof($roomAvailables) == 0) {
            return false;
        }
        $rooms_id = [];
        $i = 0;
        foreach ($roomAvailables as $roomAvailable) {
            $rooms_id[$i] = $roomAvailable['room_id'];
            $i++;
        }
        $rooms_id = array_unique($rooms_id);
        $result = array(
            'available_rooms' => $roomAvailables,
            'room_id' => $rooms_id,
        );
        return $result;
    }

    protected function checkDate($request, $isCheckIn, $isOver, $isOnlyRoom = false, $roomId = null)
    {
        $checkIn = Carbon::parse($request->checkIn)->toDateString();
        $checkOut = Carbon::parse($request->checkOut)->toDateString();
        $checkInCompare = $isOver ? '>=' : '<';
        $checkOutCompare = $isOver ? '<=' : '>';
        $date = $isCheckIn ? $checkIn : $checkOut;
        if ($request->roomInvoice) {
            $result = RoomInvoice::whereIn('status', [RoomInvoice::PAID, RoomInvoice::NOT_PAY])
                ->where('check_in_date', $checkInCompare, $isOver ? $checkIn : $date)
                ->where('check_out_date', $checkOutCompare, $isOver ? $checkOut : $date)
                ->where('id', '<>', $request->roomInvoice);
        } else {
            $result = RoomInvoice::whereIn('status', [RoomInvoice::PAID, RoomInvoice::NOT_PAY])
                ->where('check_in_date', $checkInCompare, $isOver ? $checkIn : $date)
                ->where('check_out_date', $checkOutCompare, $isOver ? $checkOut : $date);
        }


        if ($isOnlyRoom) {
            return $result->where('room_id', $roomId)->get();
        }

        return $result->get();
    }

    public function availableTimeByRoom($request, $room)
    {
        $rooms = [];
        $checkDateCheckIn = $this->checkDate($request, true, false, true, $room->id);
        $rooms = $this->getRooms($checkDateCheckIn, $rooms);
        $checkDateCheckOut = $this->checkDate($request, false, false, true, $room->id);
        $rooms = $this->getRooms($checkDateCheckOut, $rooms);
        $checkDateOver = $this->checkDate($request, true, true, true, $room->id);
        $rooms = $this->getRooms($checkDateOver, $rooms);
        if (!$rooms) {
            $result = $room->listRoomNumbers->pluck('room_number')->toArray();
        } else {
            $result = $room->listRoomNumbers->whereNotIn('room_number', $rooms[$room->id])->pluck('room_number')->toArray();
        }

        return $result;
    }

    public function checkInvoiceRoom($roomId)
    {
        $count = RoomInvoice::where('room_id', $roomId)->whereIn('status', [RoomInvoice::PAID, RoomInvoice::NOT_PAY])->count();
        if ($count == 0) {
            return true;
        };

        return false;
    }

    public function makeDataTable($location_id)
    {
        $rooms = $this->_model
            ->orderBy('id', 'desc')
            ->where('location_id', '=', $location_id)
            ->with([
                'roomName',
                'roomDetails' => function ($q) {
                    $q->where('lang_id', session('locale'));
                }
            ])
            ->whereHas('roomDetails', function ($q) {
                $q->where('lang_id', session('locale'));
            })->get();

        $roomNames = RoomName::where('lang_id', session('locale'))->get();
        foreach ($rooms as $room) {
            $room->price = number_format($room->roomDetails[0]->price);
            $room->sale_price = number_format($room->roomDetails[0]->sale_price);
            if (session('locale') == config('common.languages.default')) {
                $currency = 'vnđ';
                $name = $room->roomName->name;
            } else {
                $currency = '$';
                $roomName = $roomNames->filter(function ($value) use ($room) {
                    return $value->lang_parent_id == $room->roomName->id;
                })->first();

                if ($roomName) {
                    $name = $roomName->name;
                } else {
                    $name = $room->roomName->name;
                }
            }
            $room->name = $name;
            $room->currency = $currency;
            $room->baseLangId = session('locale') == config('common.languages.default') ? $room->roomDetails[0]->id : $room->roomDetails[0]->lang_parent_id;
        }
        return $rooms;
    }

    public function getDetailTranslate($id)
    {
        return RoomDetail::where('lang_parent_id', $id)
            ->where('lang_id', session('locale'))
            ->first();
    }

    public function searchRooms($request)
    {
        $location_id = $request->location_id;
        $adults = $request->adults;
        $children = $request->children;
        $checkin = $request->checkIn;
        $checkout = $request->checkOut;
        $location = Location::find($location_id);

        if ($location->lang_parent_id) {
            $child = Location::find($location_id);
            $location = $child->langParent;
        }
        $location->load('rooms');
        $rooms = $location->rooms;
        $roomsId = $rooms->where('adults', '>=', $adults)->where('children', '>=', $children)->pluck('id')->toArray();

        if (sizeof($roomsId) == 0) {
            return false;
        }

        $data = $this->roomAvailable($request);

        if (!$data) {
            return false;
        }

        $roomIdFound = [];

        foreach ($roomsId as $item) {
            $check = in_array($item, $data['room_id']);

            if ($check) {
                array_push($roomIdFound, $item);
            }
        }

        $rooms = $this->_model->whereIn('id', $roomIdFound)
            ->with([
                'roomName',
                'roomDetails' => function ($q) {
                    $q->where('lang_id', session('locale'));
                },
                'properties'
            ])
            ->whereHas('roomDetails', function ($q) {
                $q->where('lang_id', session('locale'));
            })->paginate(config('common.pagination.default'));

        return $rooms;
    }

    public function getRoomForBooking($roomId)
    {
        $room = $this->_model->find($roomId);
        $room->load(['roomName.children', 'roomDetails']);
        $detail = $room->roomDetails->where('lang_id', session('locale'))->first();
        $name = $room->roomName;
        if (session('locale') != config('common.languages.default')) {
            $roomName = $name->children->where('lang_parent_id', $name->id)->first();
            if ($roomName) {
                $name = $roomName->name;
            } else {
                $name = null;
            }
        } else {
            $name = $name->name;
        }

        return [
            'room' => $room,
            'detail' => $detail,
            'name' => $name,
        ];
    }

    public function getRoomHomePage($locations)
    {
        $result = [];
        foreach ($locations as $location) {
            $rooms = $location->rooms;

            foreach ($rooms as $key => $room) {

                if ($key < 2) {
                    $roomName = $room->roomName;

                    if (session('locale') == config('common.languages.default')) {
                        $room->name = $roomName->name;
                        $room->location_name = $location->name;
                        $detail = $room->roomDetails->where('lang_id', session('locale'))->first();
                        $room->detail = $detail;
                        array_push($result, $room);
                    } else {
                        $locationChild = $location->langChildren->where('lang_id', session('locale'))->first();

                        if ($locationChild) {
                            $room->location_name = $locationChild->name;
                            $child = $roomName->children->where('lang_id', session('locale'))->first();

                            if ($child) {
                                $room->name = $child->name;
                                $detail = $room->roomDetails->where('lang_id', session('locale'))->first();

                                if ($detail) {
                                    $room->detail = $detail;
                                    array_push($result, $room);
                                }
                            }
                        }
                    }
                }
            }
        }

        return $result;
    }
}
