<?php

namespace App\Repositories\Property;

use App\Models\Property;
use App\Models\Room;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class PropertyRepository extends EloquentRepository
{
    public function getModel()
    {
        return Property::class;
    }

    public function deleteProperty($id)
    {
        $property = $this->_model->find($id);

        if (is_null($property)) {
            return false;
        }

        DB::beginTransaction();
        try {
            $check = $this->checkOriginal($id);
            if ($check) {
                $property->rooms()->detach($this->getRoomId($id));
                $property->properties()->delete();
                $property->delete();
            } else {
                $property->delete();
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function getRoomId($id)
    {
        $property = $this->_model->find($id);

        if (is_null($property)) {
            return false;
        }
        $room_id = $property->rooms()->pluck('rooms.id')->toArray();

        return $room_id;
    }

    public function getNotUse($arr_id, $lang_id)
    {
        return $this->_model->whereNotIn('id', $arr_id)->where('lang_id', $lang_id)->get();
    }

    public function getByRoom($room_id)
    {
        $room = Room::find($room_id);
        $usedProperties = $room->properties;
        $notUse = $this->_model->whereNotIn('id', $usedProperties->pluck('id')->toArray())->where('lang_parent_id', 0)->get();

        return [
            'notUse' => $notUse,
            'used' => $usedProperties,
        ];
    }

    public function makeDataTable()
    {
        return $this->_model->where('lang_id', session('locale'))->orderBy('id', 'desc')->get();
    }
}
