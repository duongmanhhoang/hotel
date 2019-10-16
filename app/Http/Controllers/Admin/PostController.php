<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Post\PostRepository;
use Illuminate\Http\Request;
use Auth, Session;

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

    public function addView($postId = false)
    {
        if($postId != false) {
            $checkAvailableTranslate = $this->postRepo->find($postId);

            if($checkAvailableTranslate->lang_parent_id != null)
                return redirect()->route('admin.post.list')->with(['error' => 'Không được dịch từ bản con']);
        }

        $categories  = $this->categoryRepo->categoriesAll(null);
        $route = $postId != false ? route('admin.post.translateAction', $postId) : route('admin.post.addAction');
        $posts = $this->postRepo->searchPost(null);
        $dataTranslate = $postId != false ? true : null;
        $language = $postId != false ? $this->postRepo->getTranslateId($postId) : [];

        if($postId != false && count($language) <= 0)
            return redirect()->route('admin.post.list')->with(['error' => 'Đã đủ bản dịch']);

        $compact = compact('categories', 'route', 'posts', 'language', 'dataTranslate');

        return view('admin.posts.add', $compact);
    }

    public function store(PostRequest $request)
    {
        $input = $request->all();
        $input['lang_id'] = $this->baseLang;
        $input['posted_by'] = Auth::user()->id;

        $checkUnique = $this->postRepo->checkUniqueTitle($input);

        if(count($checkUnique) > 0) {
            return redirect()->back()->with(['error' => 'Tiêu đề đã tồn tại']);
        }

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
        $input['posted_by'] = Auth::user()->id;

        $checkUnique = $this->postRepo->checkUniqueTitle($input);

        if(count($checkUnique) > 0) {
            return redirect()->back()->with(['error' => 'Tiêu đề đã tồn tại']);
        }

        $currentPost = $this->postRepo->getPostById($postId);

        if($currentPost->category != null) {
            $categoryTranslate = $this->categoryRepo->queryCheckTranslateCategory($currentPost->category->id, $input['lang_id']);

            if(empty($categoryTranslate) || count($categoryTranslate) <= 0) {
                return redirect()->back()->with(['error' => 'Danh mục phải có bản dịch']);
            }
        }

        $this->postRepo->translate($postId, $input);

        $request->session()->flash('success', 'Dịch thành công');
        Session::put('locale', $input['lang_id']);

        return redirect()->route('admin.post.list');
    }
}
