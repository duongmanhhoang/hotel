<?php

namespace App\Repositories\RoomDetail;

use App\Models\RoomDetail;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class RoomDetailRepository extends EloquentRepository
{
    public function getModel()
    {
        return RoomDetail::class;
    }


    public function deleteRoom($id)
    {
        $check = $this->checkOriginal($id);
        $roomDetail = $this->_model->find($id);
        $room = $roomDetail->room;

        if ($check) {
            DB::beginTransaction();
            try {
                $room->roomDetails()->delete();
                $room->delete();
                DB::commit();

                return true;
            } catch (\Exception $exception) {
                DB::rollBack();

                return false;
            }
        }
        $roomDetail->delete();

        return true;
    }
}
