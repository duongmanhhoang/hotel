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

    public function delete($id)
    {
        $check = $this->checkOriginal($id);
        $location = $this->findOrFail($id);
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

    public function getLocation()
    {
        return $this->_model->orderBy('id', 'desc')->get();
    }

    public function getMainLocation()
    {
        return $this->_model->where('lang_parent_id', 0)->orderBy('id', 'desc')->get();
    }
}
