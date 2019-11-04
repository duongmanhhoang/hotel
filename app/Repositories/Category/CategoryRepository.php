<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Models\Service;
use App\Repositories\EloquentRepository;
use Session;

class CategoryRepository extends EloquentRepository
{

    const POSTS = 0;
    const SERVICES = 1;

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
        $type = $input['type'] ?? null;

        $whereConditional = [
            ['lang_id', $language],
            ['name', 'like', '%' . $name . '%'],
            $type != null ? ['type', $type] : ['type', self::POSTS]
        ];

        $result = $this->_model->where($whereConditional)->with('parentTranslate', 'childrenTranslate')->paginate($paginate);

        return $result;
    }

    public function post($input)
    {
        $result = $this->_model->create($input);

        return $result;
    }

    public function editCategory($id, $input)
    {
        $result = $this->_model->where('id', $id)->with('childrenTranslate')->first();

        if($result->childrenTranslate != null) {
            $childrenDateUpdate = [
                'type' => $input['type']
            ];

            $result->childrenTranslate()->update($childrenDateUpdate);
        }

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

    public function getCategoriesToAddParent($id = false) {
        $whereConditional = [
            ['lang_parent_id', 0],
            $id != false ? ['parent_id', '<>', $id] : ['id', '>', -1]
        ];

        $result = $this->_model->where($whereConditional)->get();

        return $result;
    }

    public function storeServiceCategory($name)
    {
        $data = [
            'type' => Category::SERVICE,
            'name' => $name,
            'parent_id' => 0,
            'lang_id' => config('common.languages.default'),
            'lang_parent_id' => 0
        ];
        $this->_model->create($data);
    }

    public function makeServiceCategoryData()
    {
        return $this->_model->where('type', Category::SERVICE)->where('lang_id', session('locale'))->get();

    }

    public function deleteServiceCategory($id)
    {
        $category = $this->_model->find($id);
        $checkOrigin = $this->checkOriginal($id);
        if ($checkOrigin) {
            $category->childrenTranslate()->delete();
            $this->delete($id);
        } else {
            $this->delete($id);
        }
    }

    public function checkServices($id)
    {
        $category = $this->_model->find($id);
        $checkOrigin = $this->checkOriginal($id);
        if ($checkOrigin) {
            $check = Service::where('cate_id', $id)->first();
        } else {
            $cateParent = $category->parentTranslate;
            $check = Service::where('cate_id', $cateParent->id)->first();
        }

        if ($check) {
            return true;
        }

        return false;
    }

}