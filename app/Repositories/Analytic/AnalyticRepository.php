<?php

namespace App\Repositories\Analytic;

use App\Models\Analytic;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticRepository extends EloquentRepository
{
    public function getModel()
    {
        return Analytic::class;
    }

    public function getWeeklyResult()
    {
        $results = [];
        $results['label'] = [];
        $results['total'] = [];
        for ($i = 0; $i < 7; $i++) {
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

    public function getHighestPageAccess()
    {
        $today = Carbon::today()->toDateString();
        $results = $this->_model
            ->select(DB::raw('count(page) as total, page'))
            ->where('time', 'LIKE', '%' . $today . '%')
            ->limit(config('common.limit.default'))
            ->orderBy('total', 'desc')
            ->groupBy('page')
            ->get();

        return $results;

    }
}