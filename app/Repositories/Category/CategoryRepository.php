<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\EloquentRepository;

class CategoryRepository extends EloquentRepository
{
    public function getModel()
    {
        return Category::class;
    }

    public function categoriesAll($id)
    {
        $result = $this->_model->where('id', '<>', $id)->orderBy('id', 'desc')->get();

        return $result;
    }

    public function getCategory($input)
    {
        $paginate = config('common.pagination.default');

        $result = $this->_model->with('parent', 'language')->paginate($paginate);

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
        $posts->update(['category_id' => null]);

        $result->delete($id);

        return !!$result;
    }


}