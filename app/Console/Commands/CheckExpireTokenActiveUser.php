<?php

namespace App\Console\Commands;

use App\Models\Statistical;
use App\Repositories\Bill\BillRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class CheckExpireTokenActiveUser extends Command
{
    protected $signature = 'command:checkExpireTokenActiveUser';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $isUserRegistered = json_decode(Redis::get('registered_time'));

        $currentTime = date('H:i:s');

        try {
            if ($isUserRegistered != null) {
                if($currentTime > $isUserRegistered->expireTime) {
                    $user = new UserRepository();

                    $userId = $isUserRegistered->userId;

                    $user->removeExpireTokenActiveUser($userId);

                    Redis::del('registered_time');
                    Redis::del('active_token');
                }
            }
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }
}
