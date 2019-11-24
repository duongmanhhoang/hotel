<?php

namespace App\Repositories\Contact;

use App\Repositories\EloquentRepository;
use App\Models\Contact;

class ContactRepository extends EloquentRepository {

    public function getModel()
    {
        return Contact::class;
    }

    public function getContact()
    {
        return $this->_model->with('location', 'userReader')->orderBy('id', 'desc')->get();
    }

    public function getContactById($id)
    {
        return $this->_model->where('id', $id)->with('location', 'userReader')->first();
    }
}
