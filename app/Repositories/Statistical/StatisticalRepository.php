<?php

namespace App\Repositories\Statistical;

use App\Repositories\EloquentRepository;
use Carbon\Carbon;

class StatisticalRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\Statistical::class;
    }

    public function searchStatistical($input)
    {
        $currentTime = Carbon::now();

        $splitInputDate = explode('-', $input['data_filter']);

        $month = $splitInputDate[1] ?? $currentTime->month;
        $year = $splitInputDate[0] ?? $currentTime->year;

        $whereConditional = [
            $month != null ? ['month', $month] : ['id', '<>', '-1'],
            $year != null ? ['year', $year] : ['id', '<>', '-1'],
        ];

        $result = $this->_model->where($whereConditional)->orderBy('day', 'asc')->limit(31)->get();

        $resultData = $this->dataToShowToTable($result);

        return $this->returnResponse($resultData);
    }

    public function statisticalByMonth()
    {
        $currentDay = Carbon::today()->format('Y-m-d');
        $previousMonth = Carbon::today()->subDay(30)->format('Y-m-d');

        $whereConditional = [
            ['time', '>=', $previousMonth],
            ['time', '<=', $currentDay],
        ];

        $result = $this->_model->where($whereConditional)->orderBy('time', 'asc')->get()->toArray();

        $dataResult = $this->dataToShowToTable($result);

        return $dataResult;
    }

    public function dataToShowToTable($data)
    {
        $arr = [];

        foreach ($data as $value) {
            if (isset($arr['day']) && is_array($arr['day']) && in_array($value['day'], $arr['day'])) continue;

            $arr['day'][] = $value['time'];
            $arr['incoming'][] = $value['incoming'];
            $arr['outgoing'][] = $value['outgoing'];
            $arr['table_message'] = 'Bảng thống kê thu chi tháng ' . $value['month'] . ' - ' . $value['year'];
        }

        return $arr;
    }

    public function returnResponse($result)
    {
        return ['status' => 'OK', 'data' => !empty($result) ? $result : 'Empty'];
    }

    public function updateStatisticalAfterUpdateBill($bill, $input)
    {
        $dayTime = explode(' ', $bill->created_at);

        $statistical = $this->findStatisticalByTime($dayTime);

        $statisticalInput['id'] = $statistical->id;
        $statisticalInput['location_id'] = $input['location_id'];
        $statisticalInput['room_id'] = $input['room_id'] ?? null;

        if ($input['type'] != $bill->type) {
            if ($input['type'] == config('common.bill.type.incoming')) {
                $statisticalInput['outgoing'] = $statistical->outgoing - $bill->money;
                $statisticalInput['incoming'] = $statistical->incoming + $input['money'];
            } else {
                $statisticalInput['outgoing'] = $statistical->outgoing + $input['money'];
                $statisticalInput['incoming'] = $statistical->incoming - $bill->money;
            }
        } else {
            if ($input['type'] == config('common.bill.type.incoming')) {
                $statisticalInput['incoming'] = $statistical->incoming - $bill->money + $input['money'];
            } else {
                $statisticalInput['outgoing'] = $statistical->outgoing - $bill->money + $input['money'];
            }
        }

        isset($statisticalInput['incoming']) && $statisticalInput['incoming'] < 0 ? $statisticalInput['incoming'] = 0 : null;
        isset($statisticalInput['outgoing']) && $statisticalInput['outgoing'] < 0 ? $statisticalInput['outgoing'] = 0 : null;

//        $arr = [
//            'statistical' => $statistical,
//            'bill' => $bill,
//            'input' => $input,
//            'arrayInputToUpdate' => $statisticalInput,
//            'inputType' => config('common.bill.type.incoming')
//        ];
//
//        dd($arr);

        $result = $statistical->update($statisticalInput);

        return $result;
    }

    public function findStatisticalByTime($time)
    {
        return $this->_model->where('time', $time)->first();
    }

    public function updateStatisticalAfterDeleteBill($statistical, $bill)
    {

        if ($bill->type == config('common.bill.type.incoming')) {
            $input['incoming'] = $statistical->incoming - $bill->money;
        } else {
            $input['outgoing'] = $statistical->outgoing - $bill->money;
        }

        $statistical->update($input);
    }


}
