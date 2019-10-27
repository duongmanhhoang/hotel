<?php

namespace App\Repositories\Analytic;

use App\Models\Analytic;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class AnalyticRepository extends EloquentRepository
{
    public function getModel()
    {
        return Analytic::class;
    }

    public function getResult($isWeekly)
    {
        $number = $isWeekly ? 7 : 30;
        $results = [];
        $results['label'] = [];
        $results['total'] = [];
        for ($i = 0; $i <= $number; $i++) {
            $day = $this->getDate($i);
            $count = $this->_model->where('time', 'LIKE', '%' . $day . '%')->count();
            array_push($results['label'], $day);
            array_push($results['total'], $count);
        }
        $results['label'] = array_reverse($results['label']);
        $results['total'] = array_reverse($results['total']);

        return $results;
    }

    protected function getDate($number)
    {
        return Carbon::today()->subDays($number)->toDateString();
    }

    public function getYearResult($data)
    {
        $results = [];
        $results['label'] = [];
        $results['total'] = [];
        $year = $data;
        $periods = CarbonPeriod::create($year . '-01-01', '1 month', $year . '-12-31');
        foreach ($periods as $period) {
            $time = $period->format("Y-m");
            $count = $this->_model->where('time', 'LIKE', '%' . $time . '%')->count();
            array_push($results['label'], $time);
            array_push($results['total'], $count);
        }

        return $results;
    }

    public function getHighestPageAccess($option)
    {
        if ($option == Analytic::TODAY_ACCESS) {
            $results = $this->getDataTodayOrYesterday(true);
        } elseif ($option == Analytic::YESTERDAY_ACCESS) {
            $results = $this->getDataTodayOrYesterday(false);
        } elseif ($option == Analytic::WEEK_AGO_ACCESS) {
            $results = $this->getDataAccess($option);
        } else {
            $results = $this->getDataAccess($option);
        }

        return $results;
    }

    protected function getDataTodayOrYesterday($isToday)
    {
        $time = $isToday ? Carbon::today()->toDateString() : Carbon::yesterday()->toDateString();
        $results = $this->_model
            ->select(DB::raw('count(page) as total, page'))
            ->where('time', 'LIKE', '%' . $time . '%')
            ->limit(config('common.limit.default'))
            ->orderBy('total', 'desc')
            ->groupBy('page')
            ->get();

        return $results;
    }

    protected function getDataAccess($option)
    {
        $today = Carbon::tomorrow()->toDateTimeString();
        $number = $option == Analytic::WEEK_AGO_ACCESS ? 7 : 30;
        $lastDay = Carbon::today()->subDays($number)->toDateTimeString();

        $results = $this->_model
            ->select(DB::raw('count(page) as total, page'))
            ->where('time', '>=', $lastDay)
            ->where('time', '<=', $today)
            ->limit(config('common.limit.default'))
            ->orderBy('total', 'desc')
            ->groupBy('page')
            ->get();

        return $results;
    }

    public function getAdvanceResult($data)
    {
        if ($data['type'] == 1) {
            $results = [];
            $results['label'] = [];
            $results['total'] = [];
            $month = $data['data'];

            $dayInMonth = Carbon::parse($month)->daysInMonth;
            for ($i = 1; $i <= $dayInMonth; $i++) {
                $day = $i < 10 ? $month . '-0' . $i : $month . '-' . $i;
                $count = $this->_model->where('time', 'LIKE', '%' . $day . '%')->count();
                array_push($results['label'], $day);
                array_push($results['total'], $count);
            }

        } else {
            $results = $this->getYearResult($data['data']);
        }

        return $results;
    }
}