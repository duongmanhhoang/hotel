<?php

namespace App\Repositories\Category;

use App\Repositories\EloquentRepository;
use App\Models\Category;
use App\Models\Post;

class CategoryRepository extends EloquentRepository {

    public function getModel()
    {
       return Category::class;
    }

    public function getCategory($input) {
        $result = $this->_model->get();

        return $result;
    }

    public function post($input)
    {
        $result = $this->_model->create($input);

        return $result;
    }

    public function editCategory($id, $input)
    {
        $result = $this->find($id);

        $result->update($input);

        return $result;
    }

    public function deleteCategory($id)
    {
        $result = $this->find($id);

        $posts = Post::where('category_id', $id);

        $posts->update(['category_id', null]);

        $result->delete($id);

        return !!$result;
    }



}