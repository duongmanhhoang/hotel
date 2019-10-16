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

    public function index(Request $request)
    {
        $input = $request->all();

        $input['name'] = $input['name'] ?? null;

        $request->session()->put('params.search.category', $input['name']);
        $nameSearch = $input['name'];

        $data = $this->categoryRepo->getCategory($input);

        $compact = compact('data', 'nameSearch');

        return view('admin.category.index', $compact);
    }

    public function addView($categoryId = false)
    {
        if($categoryId != false) {
            $checkAvailableTranslate = $this->categoryRepo->find($categoryId);

            if($checkAvailableTranslate->lang_parent_id != null)
                return redirect()->route('admin.category.list')->with(['error' => 'Không được dịch từ bản con']);
        }

        $categories  = $this->categoryRepo->getCategoriesToAddParent();
        $dataTranslate = $categoryId != false ? true : null;
        $route = $categoryId != false ? route('admin.category.categoryTranslate', ['categoryId' => $categoryId]) : route('admin.category.postAction');
        $language = $categoryId != false ? $this->categoryRepo->getTranslateId($categoryId) : [];

        if($categoryId != false && count($language) <= 0)
            return redirect()->route('admin.category.list')->with(['error' => 'Đã đủ bản dịch']);

        $compact = compact('categories', 'dataTranslate', 'language', 'route');

        return view('admin.category.add', $compact);
    }

    public function postCategory(PostCategoryRequest $request)
    {
        $input = $request->all();

        $input['lang_id'] = $this->baseLang;
        $input['parent_id'] = $input['parent_id'] ?? $this->defaultParentId;

        $this->categoryRepo->post($input);

        $request->session()->flash('success', 'Thêm danh mục thành công');
        Session::put('locale', $this->baseLang);

        return redirect()->route('admin.category.list');
    }

    public function editView($id)
    {
        $data = $this->categoryRepo->find($id);
        $categories  = $this->categoryRepo->getCategoriesToAddParent($id);
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

    public function categoryTranslate(PostCategoryRequest $request, $categoryId)
    {
        $input = $request->all();

        $checkParentTranslate = $this->categoryRepo->checkParentTranslate($categoryId, $input['lang_id']);

        if($checkParentTranslate == false) {
            $language = $this->languageRepo->find($input['lang_id']);
            $request->session()->flash('error', 'Danh mục cha chưa có bản dịch cho ngôn ngữ ' . $language->name);

            return redirect()->back();
        }

        $this->categoryRepo->categoryTranslate($categoryId, $input);

        $request->session()->flash('success', 'Dịch thành công');
        Session::put('locale', $input['lang_id']);

        return redirect()->route('admin.category.list');
    }
}
