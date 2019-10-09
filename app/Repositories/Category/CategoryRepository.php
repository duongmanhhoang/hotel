<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\EloquentRepository;
use Session;

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
        $language = Session::get('locale');
        $name = $input['name'] ?? null;

        $whereConditional = [
            ['lang_id', $language],
            ['name', 'like', '%' . $name . '%']
        ];

        $result = $this->_model->where($whereConditional)->with('parent', 'language', 'parentTranslate', 'childrenTranslate')->paginate($paginate);

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

    public function categoryTranslate($id, $input)
    {
        $input['lang_parent_id'] = $id;

        $result = $this->_model->create($input);

        return $result;
    }

}