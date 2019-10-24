<?php

namespace App\Repositories\RoomName;

use App\Models\RoomName;
use App\Repositories\EloquentRepository;

class RoomNameRepository extends EloquentRepository
{
    public function getModel()
    {
        return RoomName::class;
    }

}
