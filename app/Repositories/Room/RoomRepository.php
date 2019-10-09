<?php

namespace App\Repositories\Room;

use App\Models\ListRoomNumber;
use App\Models\Room;
use App\Models\RoomDetail;
use App\Repositories\EloquentRepository;
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

    public function deleteRoomNumber($roomNumbers , $room_number)
    {
        foreach ($roomNumbers as $roomNumber) {
            if ($roomNumber->room_number == $room_number) {
                $number = ListRoomNumber::find($roomNumber->id);
                $number->delete();

                return true;
            }
        }
    }
}
