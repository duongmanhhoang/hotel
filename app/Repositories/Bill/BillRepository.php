<?php

namespace App\Repositories\Bill;

use App\Models\Bill;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BillRepository extends EloquentRepository
{
    public function getModel()
    {
        return Bill::class;
    }

    public function searchBill($input)
    {
        $paginate = config('common.pagination.default');

        $result = $this->_model->with('location')->orderBy('id', 'desc')->paginate($paginate);

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

    public function deleteBill($id)
    {
        $result = $this->find($id);

        $result->delete();

        return !!$result;
    }

    public function findBillById($id)
    {
        $result = $this->_model->where('id', $id)->with('location')->first();

        return $result;
    }

    public function recordsDailyInsert()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');
        $arrayToInsert = [];


        $whereConditional = [
            ['created_at', '>=', $yesterday . ' 00:00:00'],
            ['created_at', '<=', $today . ' 00:00:00']
        ];

        $yesterdaySplit = explode('-', $yesterday);

        $y = $yesterdaySplit[0];
        $m = $yesterdaySplit[1];
        $d = $yesterdaySplit[2];


        $result = $this->_model->select(DB::raw('sum(if(type = 1, 0, 1)) as incoming, sum(if(type = 2, 0, 1)) as outgoing, location_id'))->where($whereConditional)->groupBy('location_id')->get();

        foreach ($result as $value) {
            $data = [
                'time' => $yesterday,
                'day' => $d,
                'month' => $m,
                'year' => $y,
                'incoming' => $value->incoming,
                'outgoing' => $value->outgoing,
                'location_id' => $value->location_id,
                'room_id' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            array_push($arrayToInsert, $data);
        }

        return $arrayToInsert;
    }

    public function groupRecordsByLocation($records)
    {
        $data = [];

        foreach ($records as $record)
        {
            $data[$record->location_id] = $record;
        }

        return $data;
    }
}