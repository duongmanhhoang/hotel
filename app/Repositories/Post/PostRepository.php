<?php

namespace App\Repositories\Post;

use App\Repositories\EloquentRepository;
use App\Models\Post;

class PostRepository extends EloquentRepository
{
    public function getModel()
    {
        return Post::class;
    }

    public function searchPost($input)
    {
        $resuslt = $this->_model->get();

        return $resuslt;
    }

    public function insertPost($input)
    {

    }

    public function editPost($id, $input)
    {
        $result = $this->find($id);

        $result->update($input);

        return $result;
    }

    public function delete($id)
    {

    }
}
