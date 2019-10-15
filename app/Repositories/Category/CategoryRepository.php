<?php

namespace App\Repositories\Category;

use App\Models\Category;
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
        $result = $this->_model->where('id', $id)->with('children')->first();

        if (!empty($result->children)) {
            foreach ($result->children as $child) {
                $child->childrenTranslate()->delete();
                $child->delete();
            }
        }

        $result->delete($id);

        return !!$result;
    }

    public function categoryTranslate($id, $input)
    {
        $input['lang_parent_id'] = $id;

        $result = $this->_model->create($input);

        return $result;
    }

    public function checkParentTranslate($id, $langId)
    {
        $result = $this->_model->where('id', $id)->with('parent')->first();

        if (!empty($result->parent)) {

            $parentRecord = $this->queryCheckTranslateCategory($result->parent->id, $langId);

            if (empty($parentRecord) || count($parentRecord) <= 0 || $parentRecord == null) {
                return false;
            }

        }

        return true;
    }

    public function queryCheckTranslateCategory($parentId, $langId)
    {
        return $this->_model->where(['lang_parent_id' => $parentId, 'lang_id' => $langId])->get();
    }

}