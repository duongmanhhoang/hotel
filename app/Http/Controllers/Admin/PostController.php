<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Post\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        LanguageRepository $languageRepository
        )
    {
        $this->postRepo = $postRepository;
        $this->languageRepo = $languageRepository;
        $this->categoryRepo = $categoryRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function index(Request $request)
    {
        $input = $request->all();

        $input['title'] = $input['title'] ?? null;

        $request->session()->put('params.search.post_title', $input['title']);
        $titleSearch = $input['title'];

        $data = $this->postRepo->searchPost($input);

        return view('admin.posts.index', compact('data', 'titleSearch'));
    }

    public function addView(Request $request, $postId = false)
    {
        $input = $request->all();

        $categories  = $this->categoryRepo->categoriesAll(null);
        $route = $postId != false ? route('admin.post.translateAction', $postId) : route('admin.post.addAction');
        $posts = $this->postRepo->searchPost($input);
        $dataTranslate = $postId != false ? true : null;
        $language = $this->languageRepo->getLanguage();

        $compact = compact('categories', 'route', 'posts', 'language', 'dataTranslate');

        return view('admin.posts.add', $compact);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['lang_id'] = $this->baseLang;

        $this->postRepo->insertPost($input);

        return redirect()->route('admin.post.list');
    }

    public function editView($id)
    {
        $data = $this->postRepo->getPostById($id);

        $categories  = $this->categoryRepo->categoriesAll(null);
        $route = route('admin.post.editAction', ['id' => $id]);

        $compact = compact('categories', 'route', 'data');

        return view('admin.posts.add', $compact);
    }

    public function postEdit(Request $request, $id)
    {
        $input = $request->all();

        $this->postRepo->editPost($id, $input);

        return redirect()->route('admin.post.list');
    }

    public function delete($id)
    {
        $this->postRepo->deletePost($id);

        return redirect()->back();
    }

    public function translate(Request $request, $postId)
    {
        $input = $request->all();
        $this->postRepo->translate($postId, $input);

        return redirect()->route('admin.post.list');
    }
}
