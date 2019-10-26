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

        \App\Models\Statistical::insert($arr);
    }
}
