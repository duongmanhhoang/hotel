<?php

namespace App\Console\Commands;

use App\Repositories\Room\RoomRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ChangeSaleStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:changeSaleStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change Sale Status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        parent::__construct();
        $this->roomRepository = $roomRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->roomRepository->changeSaleStatus();
        }catch (\Exception $exception) {
            Log::error($exception);
        }
    }
}
