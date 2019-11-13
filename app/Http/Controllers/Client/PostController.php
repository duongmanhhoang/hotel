<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\PostRepository;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->postRepo = $postRepository;
        $this->cateRepo = $categoryRepository;
    }

    public function index()
    {
        $data = $this->postRepo->getClientPost();

        $randomPost = $this->postRepo->getRandomPost();

        return view('client.blog.index', compact('data', 'randomPost'));
    }

    public function detail($id)
    {
        $data = $this->postRepo->clientDetail($id);

        if (empty($data)) return redirect()->route('post.index')->with(['error' => 'Không tìm thấy bài viết']);

        $sameCategory = $this->postRepo->postsSameCategory($data);

        return view('client.blog.blog_detail', compact('data', 'sameCategory'));
    }

    public function getPostViaCategoryName($name)
    {
        $language = Session::get('locale');

        $currentCategory = $this->cateRepo->getCategoryByName($name);

        if ($currentCategory == null) return redirect()->back()->with(['error' => __('messages.not_found')]);

        $checkCategoryTrans = $this->cateRepo->checkIsTranslateCurrentCategory($currentCategory, $language);

        $name = $checkCategoryTrans;

        $data = $this->postRepo->getClientPostViaCategoryName($name);

        $randomPost = $this->postRepo->getRandomPost();

        return view('client.blog.index', compact('data', 'randomPost'));
    }
}
