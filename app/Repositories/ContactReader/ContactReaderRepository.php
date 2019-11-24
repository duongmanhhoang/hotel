<?php

namespace App\Repositories\ContactReader;

use App\Models\ContactReader;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Auth;

class ContactReaderRepository extends EloquentRepository {

    public function getModel()
    {
        return ContactReader::class;
    }

    public function findUserViaContactId($id)
    {
        $userId = Auth::user()->id;

        return $this->_model->where('contact_id', $id)->where('user_id', $userId)->first();
    }

    public function insertReader($id)
    {
        $userId = Auth::user()->id;

        $this->_model->create(['contact_id' => $id, 'user_id' => $userId]);
    }
}
