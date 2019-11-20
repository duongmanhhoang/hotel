<?php

namespace App\Repositories\RoomName;

use App\Models\Room;
use App\Models\RoomName;
use App\Repositories\EloquentRepository;

class RoomNameRepository extends EloquentRepository
{
    public function getModel()
    {
        return RoomName::class;
    }

    public function deleteRoomName($id)
    {
        $roomName = $this->_model->find($id);
        $checkOrigin = $this->checkOriginal($id);
        $checkUsed = $this->checkUsed($id, $checkOrigin);
        if (!$checkUsed) {
            if ($checkOrigin) {
                $roomName->children()->delete();
                $roomName->delete();
            } else {
                $roomName->delete();
            }

            return true;
        }

        return false;

    }

    public function checkUsed($id, $isOrigin)
    {
        if ($isOrigin) {
            $roomNameId = $id;
        } else {
            $roomName = $this->_model->find($id);
            $origin = $this->_model->where('id', $roomName->lang_parent_id)->first();
            $roomNameId = $origin->id;
        }
        $count = Room::where('room_name_id', $roomNameId)->count();
        if ($count > 0) {
            return true;
        }

        return false;
    }

    public function findRoomName($id)
    {
        return $this->_model->where('lang_parent_id', $id)->where('lang_id', session('locale'))->first();
    }

    public function makeDataTable()
    {
        $roomNames = $this->_model->where('lang_id', session('locale'))->orderBy('id', 'desc')->get();

        return $roomNames;
    }

}
