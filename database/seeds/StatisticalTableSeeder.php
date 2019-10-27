<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatisticalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        $curDay = null;

        for($i = 0; $i < 500; $i++) {
//            $currentDay = $curDay ?? Carbon::today();
//            $subDay = $currentDay->subDay(1);
//            $formatDay = $subDay->format('Y-m-d');
//
//            $daySplit = explode('-', $formatDay);

            $year = rand(2018, 2019);
            $month = rand(1, 12);
            $day = rand(1, 28);

            $formatDay = "$year-$month-$day";
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

//            $curDay = $subDay;
        }

        \App\Models\Statistical::insert($arr);
    }
}
