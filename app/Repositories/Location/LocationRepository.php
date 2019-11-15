<?php

namespace App\Repositories\Location;

use App\Models\Location;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class LocationRepository extends EloquentRepository
{
    public function getModel()
    {
        return Location::class;
    }

    public function deleteLocation($id)
    {
        $check = $this->checkOriginal($id);
        $location = $this->findOrFail($id);
        $checkRoom = $this->checkRooms($location);
        if ($check) {
            DB::beginTransaction();
            try {
                $location->locations()->delete();
                $location->delete();
                DB::commit();

                return true;
            } catch (\Exception $exception) {
                DB::rollBack();

                return false;
            }

        } else {
            $location->delete();

            return true;
        }
    }

    public function checkRooms($id)
    {
        if (session('locale') == config('common.languages.default')) {
            $location = $this->_model->find($id);
        } else {
            $child = $this->_model->find($id);
            $location = $this->_model->find($child->lang_parent_id);
        }

        $rooms = $location->rooms;
        if ($rooms) {
            return true;
        }

        return false;
    }

    public function getLocation()
    {
        return $this->_model->orderBy('id', 'desc')->get();
    }

    public function getMainLocation()
    {
        return $this->_model->where('lang_parent_id', 0)->orderBy('id', 'desc')->get();
    }

    public function makeDataTable()
    {
        $locations = $this->_model->where('lang_id', session('locale'))->get();

        return $locations;
    }

    public function contactGetLocation()
    {
        $language = session('locale');

        return $this->_model->where('lang_id', $language)->get();
    }
}
