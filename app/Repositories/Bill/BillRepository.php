<?php

namespace App\Repositories\Bill;

use App\Models\Bill;
use App\Repositories\EloquentRepository;
use App\Repositories\Location\LocationRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BillRepository extends EloquentRepository
{
    public function getModel()
    {
        return Bill::class;
    }

    public function searchBill()
    {
        $result = $this->_model->with('location')->orderBy('id', 'desc')->get();

        return $result;
    }

    public function insertBill($input)
    {
        $result = $this->_model->create($input);

        return $result;
    }

    public function updateBill($id, $input)
    {
        $result = $this->find($id);

        $result->update($input);

        return $result;
    }

    public function deleteBill($bill)
    {
        $bill->delete();

        return !!$bill;
    }

    public function findBillById($id)
    {
        $result = $this->_model->where('id', $id)->with('location')->first();

        return $result;
    }

    public function recordsDailyInsert()
    {
        $locationsRepo = new LocationRepository();
        $locations = $locationsRepo->getMainLocation();

        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');
        $arrayToInsert = [];
        $array = [];

        $whereConditional = [
            ['created_at', '>=', $yesterday . ' 00:00:00'],
            ['created_at', '<=', $today . ' 00:00:00']
        ];

        $yesterdaySplit = explode('-', $yesterday);

        $y = $yesterdaySplit[0];
        $m = $yesterdaySplit[1];
        $d = $yesterdaySplit[2];

        $result = $this->_model->select(DB::raw('if(type = 1, sum(money), 0) as incoming, if(type = 2, sum(money), 0) as outgoing, location_id, type'))->where($whereConditional)->groupBy('location_id', 'type')->get()->toArray();

        foreach ($result as $value) {
            $array[$value['location_id']][] = $value;
        }

        for($i = 0; $i < count($locations); $i++) {
            $locationValue = $locations[$i];
            $data = [
                'time' => $yesterday,
                'day' => $d,
                'month' => $m,
                'year' => $y,
                'incoming' => 0,
                'outgoing' => 0,
                'location_id' => $locationValue->id,
                'room_id' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if(!empty($array)) {
                if(isset($array[$locationValue->id])) {
                    $value = $array[$locationValue->id];
                    $incoming = count($value) > 1 ? $value[0]['incoming'] + $value[1]['incoming'] : $value[0]['incoming'];
                    $outgoing = count($value) > 1 ? $value[0]['outgoing'] + $value[1]['outgoing'] : $value[0]['outgoing'];

                    $data['incoming'] = intval($incoming);
                    $data['outgoing'] = intval($outgoing);
                }
            }

            array_push($arrayToInsert, $data);
        }

        return $arrayToInsert;
    }

    public function calculateMoneyLocation($arrayValue)
    {
        $data = null;
        $arr = [];
        for ($i = 0; $i < count($arrayValue); $i++) {
            $value = $arrayValue[$i];

            $data = [
                'incoming' => $data != null ? $data['incoming'] += $value['incoming'] : $value['incoming'],
                'outgoing' => $value['outgoing'],
                'location_id' => $value['location_id'],
                'room_id' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            array_push($arr, $data);
        }

        $arrayValue = $data;

        return $arr;
    }

    public function groupRecordsByLocation($records)
    {
        $data = [];

        foreach ($records as $record) {
            $data[$record->location_id] = $record;
        }

        return $data;
    }
}