<?php

namespace App\Repositories\WebSetting;

use App\Models\WebSetting;
use App\Repositories\EloquentRepository;

class WebSettingRepository extends EloquentRepository
{
    public function getModel()
    {
        return WebSetting::class;
    }
}
