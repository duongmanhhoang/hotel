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
            if(isset($arr['day']) && is_array($arr['day']) && in_array($value['day'], $arr['day'])) continue;

            $arr['day'][] = $value['time'];
            $arr['incoming'][] = $value['incoming'];
            $arr['outgoing'][] = $value['outgoing'];
        }

        return $arr;
    }

    public function fakeData()
    {
        $arr = [];
        $curDay = null;

        for($i = 0; $i < 30; $i++) {
            $currentDay = $curDay ?? Carbon::today();
            $subDay = $currentDay->subDay(1);
            $formatDay = $subDay->format('Y-m-d');

            $daySplit = explode('-', $formatDay);

            $year = $daySplit[0];
            $month = $daySplit[1];
            $day = $daySplit[2];

            $randomIncoming = rand(100000, 100000000);
            $randomOutgoing = rand(100000, 100000000);

            $data = [
                'time' => $formatDay,
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'incoming' => $randomIncoming,
                'outgoing' => $randomOutgoing,
                'location_id' => rand(1, 2)
            ];

            array_push($arr, $data);

            $curDay = $subDay;
        }

        $this->_model->insert($arr);

        return $arr;
    }

}
