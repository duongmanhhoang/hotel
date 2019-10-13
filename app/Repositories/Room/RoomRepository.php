<?php

namespace App\Repositories\Room;

use App\Models\ListRoomNumber;
use App\Models\Location;
use App\Models\Room;
use App\Models\RoomDetail;
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
            'sale_start_at' => $data['sale_start_at'],
            'sale_end_at' => $data['sale_end_at'],
            'adults' => $data['adults'],
            'children' => $data['children'],
        ];
    }

    public function makeRoomDetailUpdate($data)
    {
        return [
            'name' => $data['name'],
            'price' => $data['price'],
            'sale_price' => $data['sale_price'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
        ];
    }

    public function makeRoomData($data, $location_id)
    {
        $dataRoom = [
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
            'name' => $data['name'],
            'price' => $data['price'],
            'sale_price' => $data['sale_price'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
            'lang_id' => config('common.languages.default'),
            'lang_parent_id' => 0,
        ];

        return $dataRoomDetail;
    }

    public function deleteRoomNumber($roomNumbers, $room_number)
    {
        foreach ($roomNumbers as $roomNumber) {
            if ($roomNumber->room_number == $room_number) {
                $number = ListRoomNumber::find($roomNumber->id);
                $number->delete();

                return true;
            }
        }
    }

    public function roomAvailable($request)
    {
        $check_in_day = Carbon::parse($request->checkIn);
        $check_out_day = Carbon::parse($request->checkOut);
        $rooms = $this->_model->all();
//        if ($location) {
//            $location = Location::find($location);
//            if (is_null($location)) {
//                return false;
//            }
//        }

//        if (isset($_GET['properties'])) {
//            $properties = $_GET['properties'];
//            $rooms = Room::whereHas('properties', function ($query) use ($properties) {
//                $query->whereIn('properties.id', $properties);
//            })->get();
//        } else {
//            $rooms = $location->rooms()->get();
//        }
        foreach ($rooms as $room) {
            if ($room->available_time) {
                $available_times = json_decode($room->available_time, true);
                foreach ($available_times as $available_time) {
                    $check_in_available = Carbon::parse($available_time['check_in']);
                    $check_out_available = Carbon::parse($available_time['check_out']);
                    $between_checkin = $check_in_available->diff($check_in_day);
                    $between_checkin_checkout = $check_in_day->diff($check_out_day);
                    $between_checkout = $check_out_day->diff($check_out_available);
                    if ($between_checkin->invert == 0 && $between_checkin_checkout->days <= $available_time['length'] && $between_checkout->invert == 0) {
                        if (isset($available_rooms)) {
                            $arr_push = array(
                                'room_id' => $room->id,
                                'room_number' => $available_time['available_rooms'],
                            );
                            array_push($available_rooms, $arr_push);
                        } else {
                            $available_rooms = [];
                            $available_rooms = array(
                                array(
                                    'room_id' => $room->id,
                                    'room_number' => $available_time['available_rooms'],
                                ),
                            );
                        };
                    }
                }
            };
        }
        if (!isset($available_rooms)) {
            return false;
        }
        $rooms_id = [];
        $i = 0;
        foreach ($available_rooms as $available_room) {
            $rooms_id[$i] = $available_room['room_id'];
            $i++;
        }
        $rooms_id = array_unique($rooms_id);
        $result = array(
            'available_rooms' => $available_rooms,
            'room_id' => $rooms_id,
        );

        return $result;
    }

    public function availableTimeByRoom($room, $check_in_day, $check_out_day)
    {
        $available_times = json_decode($room->available_time, true);
        foreach ($available_times as $available_time) {
            $check_in_available = Carbon::parse($available_time['check_in']);
            $check_out_available = Carbon::parse($available_time['check_out']);
            $between_checkin = $check_in_available->diff($check_in_day);
            $between_checkin_checkout = $check_in_day->diff($check_out_day);
            $between_checkout = $check_out_day->diff($check_out_available);
            if ($between_checkin->invert == 0 && $between_checkin_checkout->days <= $available_time['length'] && $between_checkout->invert == 0) {
                if (isset($available_rooms)) {
                    $arr_push = $available_time['available_rooms'];
                    array_push($available_rooms, $arr_push);
                } else {
                    $available_rooms = [];
                    $available_rooms =  $available_time['available_rooms'];
                };
            };
        };

        return $available_rooms;

    }

    public function updateAvailableTime($room_id, $check_in, $check_out, $room_number)
    {
        $room = $this->_model->find($room_id);
        if (is_null($room)) {
            return false;
        }
        $check_arr = json_decode($room->available_time, true);
        foreach ($check_arr as $key => $item) {
            $checkin = Carbon::parse($check_in);
            $checkout = Carbon::parse($check_out);
            $check_in_available = Carbon::parse($item['check_in']);
            $check_out_available = Carbon::parse($item['check_out']);
            $diff = $check_in_available->diff($checkin);
            $diff2 = $check_in_available->diff($check_out_available);
            $diff3 = $checkin->diff($checkout);
            if ($diff->invert == 0 && $diff2->days >= $diff3->days) {
                $new = [];
                $new['check_in'] = $item['check_in'];
                $new['check_out'] = $check_in;
                $new_check_in = Carbon::parse($item['check_in']);
                $new_check_out = Carbon::parse($check_in);
                $new['length'] = $new_check_in->diff($new_check_out)->days;
                $new2 = [];
                $new2['check_in'] = $check_out;
                $new2['check_out'] = $item['check_out'];
                $new_check_in = Carbon::parse($check_out);
                $new_check_out = Carbon::parse($item['check_out']);
                $new2['length'] = $new_check_in->diff($new_check_out)->days;
                if (count($item['available_rooms']) == 1) {
                    if ($new['length'] > 0) {
                        $new['available_rooms'] = $item['available_rooms'];
                        array_push($check_arr, $new);
                    }
                    if ($new2['length'] > 0) {
                        $new2['available_rooms'] = $item['available_rooms'];
                        array_push($check_arr, $new2);
                    }
                    unset($check_arr[$key]);
                } else {
                    if ($new['length'] > 0) {
                        $available_rooms = $item['available_rooms'];
                        $room_number_key = array_search($room_number, $available_rooms);
                        $new['available_rooms'] = array($available_rooms[$room_number_key]);
                        array_push($check_arr, $new);
                    }
                    if ($new2['length'] > 0) {
                        $available_rooms = $item['available_rooms'];
                        $room_number_key = array_search($room_number, $available_rooms);
                        $new2['available_rooms'] = array($available_rooms[$room_number_key]);
                        array_push($check_arr, $new2);
                    }
                    unset($check_arr[$key]['available_rooms'][$room_number_key]);
                }
            };
        }
        $room->available_time = json_encode($check_arr, true);
        $room->save();
    }
}
