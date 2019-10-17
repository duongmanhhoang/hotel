<?php

namespace App\Repositories\Bill;

use App\Models\Bill;
use App\Repositories\EloquentRepository;

class BillRepository extends EloquentRepository
{
    public function getModel()
    {
        return Bill::class;
    }

    public function searchBill($input)
    {
        $paginate = config('common.pagination.default');

        $result = $this->_model->with('location')->orderBy('id', 'desc')->paginate($paginate);

        return $result;
    }

    public function insertBill($input)
    {
        $result = $this->_model->create($input);

        return $result;
    }

    public function updateBill($id, $input)
    {
        $result = $this->find($id);

        $result->update($input);

        return $result;
    }

    public function deleteBill($id)
    {
        $result = $this->find($id);

        $result->delete();

        return !!$result;
    }

    public function findBillById($id)
    {
        $result = $this->_model->where('id', $id)->with('location')->first();

        return $result;
    }
}