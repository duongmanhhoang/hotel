<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PostCategoryRequest;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Language\LanguageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function __construct(
        CategoryRepository $categoryRepository,
        LanguageRepository $languageRepository
    )
    {
        $this->categoryRepo = $categoryRepository;
        $this->languageRepo = $languageRepository;
        $this->baseLang = config('common.languages.default');
        $this->defaultParentId = config('common.categories.default_parent_id');
    }

    public function getCategory(Request $request)
    {
        $input = $request->all();

        $request->session()->put('params.search.category', $input['name']);
        $nameSearch = $input['name'];

        $data = $this->categoryRepo->getCategory($input);

        return view('admin.category.index', compact('data', 'nameSearch'));
    }

    public function addView($categoryId = false)
    {
        $categories  = $this->categoryRepo->categoriesAll(null);
        $dataTranslate = $categoryId != false ? $this->categoryRepo->find($categoryId) : null;
        $route = $categoryId != false ? route('admin.category.categoryTranslate', ['categoryId' => $dataTranslate->id]) : route('admin.category.postAction');
        $language = $this->languageRepo->getLanguage();

        $compact = compact('categories', 'dataTranslate', 'language', 'route');

        return view('admin.category.add', $compact);
    }

    public function postCategory(PostCategoryRequest $request)
    {
        $input = $request->all();

        $input['lang_id'] = $this->baseLang;
        $input['parent_id'] = $input['parent_id'] ?? $this->defaultParentId;

        $this->categoryRepo->post($input);

        $request->session()->flash('success', 'Thêm cơ sở thành công');
        Session::put('locale', $this->baseLang);

        return redirect()->route('admin.category.list');
    }

    public function editView($id)
    {
        $data = $this->categoryRepo->find($id);
        $categories  = $this->categoryRepo->categoriesAll($id);
        $route = route('admin.category.editAction', ['id' => $id]);

        $compact = compact('data', 'categories', 'route');

        return view('admin.category.add', $compact);
    }

    public function postEdit(PostCategoryRequest $request)
    {
        $input = $request->all();
        $id = $input['id'];

        $this->categoryRepo->editCategory($id, $input);

        $request->session()->flash('success', 'Sửa thành công');

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $data = $this->categoryRepo->deleteCategory($id);

        if ($data == true) {
            $request->session()->flash('success', 'Xóa thành công');
        } else {
            $request->session()->flash('error', 'Có lỗi xảy ra');
        }

        return redirect()->back();
    }

    public function categoryTranslate(Request $request, $categoryId)
    {
        $input = $request->all();
        $this->categoryRepo->categoryTranslate($categoryId, $input);

        return redirect()->route('admin.category.list');
    }
}
