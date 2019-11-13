<?php

namespace App\Repositories\Unit;

use App\Models\Service;
use App\Models\Unit;
use App\Repositories\EloquentRepository;

class UnitRepository extends EloquentRepository
{
    public function getModel()
    {
        return Unit::class;
    }

    public function makeDataTable()
    {
        return $this->_model->where('lang_id', session('locale'))->orderBy('id', 'desc')->get();
    }

    public function checkService($id)
    {
        $unit = $this->_model->find($id);
        $checkOrigin = $this->checkOriginal($id);

        if ($checkOrigin) {
            $check = Service::where('unit_id', $unit->id)->first();
        } else {
            $unitOrigin = $unit->langParent;
            $check = Service::where('unit_id', $unitOrigin->id)->first();
        }

        if ($check) {
            return true;
        }

        return false;
    }

    public function deleteUnit($id)
    {
        $unit = $this->_model->find($id);
        $checkOrigin = $this->checkOriginal($id);
        if ($checkOrigin) {
            $unit->langChildren()->delete();
            $this->delete($id);
        } else {
            $this->delete($id);
        }
    }
}
