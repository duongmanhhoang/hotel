<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PostCategoryRequest;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
        $this->baseLang = config('common.languages.default');
        $this->defaultParentId = config('common.categories.default_parent_id');
    }

    public function getCategory(Request $request)
    {
        $input = $request->all();

        $data = $this->categoryRepo->getCategory($input);

        return view('admin.category.index', compact('data'));
    }

    public function addView()
    {
        $categories  = $this->categoryRepo->categoriesAll(null);

        return view('admin.category.add', compact('categories'));
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
        
        return view('admin.category.add', compact('data', 'categories'));
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
}
