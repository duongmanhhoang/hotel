<?php

namespace App\Repositories\Statistical;

use App\Repositories\EloquentRepository;
use App\Repositories\Location\LocationRepository;
use Carbon\Carbon;

class StatisticalRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Models\Statistical::class;
    }

    public function searchStatistical($input)
    {
        $locationRepo = new LocationRepository();
        $defaultLocation = $locationRepo->getHaNoiLocation();
        $currentTime = Carbon::now();

        $splitInputDate = explode('-', $input['data_filter']);
        $locationId = $input['location_id'] ?? $defaultLocation->id;
        $month = $currentTime->month;
        $year = $currentTime->year;

        if($splitInputDate[0] != '') {
            $month = $splitInputDate[1];
            $year = $splitInputDate[0];
        }

        $whereConditional = [
            $month != null ? ['month', $month] : ['id', '<>', '-1'],
            $year != null ? ['year', $year] : ['id', '<>', '-1'],
            ['location_id', $locationId]
        ];

        $result = $this->_model->where($whereConditional)->with('location')->orderBy('day', 'asc')->limit(31)->get();

        $resultData = $this->dataToShowToTable($result);

        return $this->returnResponse($resultData);
    }

    public function statisticalByMonth()
    {
        $locationRepo = new LocationRepository();
        $defaultLocation = $locationRepo->getHaNoiLocation()->id;
        $currentDay = Carbon::today()->format('Y-m-d');
        $previousMonth = Carbon::today()->subDay(30)->format('Y-m-d');

        $whereConditional = [
            ['time', '>=', $previousMonth],
            ['time', '<=', $currentDay],
            ['location_id', $defaultLocation]
        ];

        $result = $this->_model->where($whereConditional)->with('location')->orderBy('time', 'asc')->get()->toArray();

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
            $arr['table_message'] = 'Bảng thống kê thu chi tháng ' . $value['month'] . ' - ' . $value['year'] . ' cơ sở ' . $value['location']['name'];
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
