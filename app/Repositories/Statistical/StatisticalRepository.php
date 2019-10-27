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

        $month = $input['month'] ?? $currentTime->month;
        $year = $input['year'] ?? $currentTime->year;

        $whereConditional = [
            $month != null ? ['month', $month] : ['id', '<>', '-1'],
            $year != null ? ['year', $year] : ['id', '<>', '-1'],
        ];

        $result = $this->_model->where($whereConditional)->orderBy('day', 'asc')->limit(30)->get();

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

        $result = $this->_model->where($whereConditional)->orderBy('day', 'asc')->get()->toArray();

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
        }

        return $arr;
    }

    public function returnResponse($result) {
        return ['status' => 'OK', 'data' => !empty($result) ? $result : 'Empty'];
    }

}
