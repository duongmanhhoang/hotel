<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PostCategoryRequest;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function getCategory(Request $request)
    {
        $input = $request->all();

        $data = $this->categoryRepo->getCategory($input);

        dd($data);
    }

    public function addView()
    {
        return view('admin.category.add');
    }

    public function postCategory(PostCategoryRequest $request)
    {
        $input = $request->all();

        $input['lang_id'] = 1;

        $data = $this->categoryRepo->post($input);

        dd($data);
    }

    public function editView($id)
    {
        $data = $this->categoryRepo->find($id);

        return view('admin.category.add', compact('data'));
    }

    public function postEdit(PostCategoryRequest $request)
    {
        $input = $request->all();
        $id = $input['id'];

        $data =$this->categoryRepo->editCategory($id, $input);

        dd($data);
    }

    public function delete($id)
    {
        $data = $this->categoryRepo->deleteCategory($id);
    }
}
