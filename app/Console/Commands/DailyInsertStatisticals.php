<?php

namespace App\Console\Commands;

use App\Models\Statistical;
use App\Repositories\Bill\BillRepository;
use Illuminate\Console\Command;
use Log;

class DailyInsertStatisticals extends Command
{
    protected $signature = 'dailyInsert:statistical';

    protected $description = 'Daily insert to statistical';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $bills = new BillRepository();
            $statistical = new Statistical();

            $records = $bills->recordsDailyInsert();

            $statistical->insert($records);
        }catch (\Exception $exception) {
            Log::error($exception);
        }
    }
}
