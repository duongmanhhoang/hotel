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
        $this->pendingPost = config('common.posts.approve_key.pending');
    }

    public function index(Request $request, $status = 'approved')
    {
        $input = $request->all();
        $approveStatus = config("common.posts.approve_key.$status");

        $input['title'] = $input['title'] ?? null;
        $input['approve'] = $approveStatus;

        $request->session()->put('params.search.post_title', $input['title']);
        $titleSearch = $input['title'];

        $data = $this->postRepo->searchPost($input);

        return view('admin.posts.index', compact('data', 'titleSearch'));
    }

    public function addView($postId = false)
    {
        if($postId != false) {
            $checkAvailableTranslate = $this->postRepo->find($postId);

            if($checkAvailableTranslate == null) return redirect()->back()->with(['error' => 'Không tìm thấy dữ liệu']);

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

        $request->session()->flash('success', 'Thêm bài viết thành công');

        return redirect()->route('admin.post.list');
    }

    public function editView($id)
    {
        $data = $this->postRepo->getPostById($id);
        $categories  = $this->categoryRepo->categoriesAll(null);
        $route = route('admin.post.editAction', ['id' => $id]);

        if($data == null) {
            return redirect()->back()->with(['error' => 'Không tìm thấy dữ liệu']);
        }

        $compact = compact('categories', 'route', 'data');

        return view('admin.posts.add', $compact);
    }

    public function postEdit(Request $request, $id)
    {
        $input = $request->all();

        $this->postRepo->editPost($id, $input);

        $request->session()->flash('success', 'Cập nhật thành công');

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

    public function getPendingPosts(Request $request)
    {
        $input['approve'] = config('common.posts.approve_key.pending');

        $input['title'] = $input['title'] ?? null;

        $request->session()->put('params.search.post_title', $input['title']);
        $titleSearch = $input['title'];

        $data = $this->postRepo->searchPost($input);

        return view('admin.posts.approve', compact('data', 'titleSearch'));
    }

    public function approvingPost(Request $request, $id, $approve)
    {
        $input = $request->all();

        if($approve == -1 && empty($input['message_reject'])) {
            return redirect()->back()->with(['error' => 'Không được bỏ trống lí do từ chối']);
        }

        $input['approve'] = $approve;

        $dataApprove = $this->postRepo->approvePost($id, $input);

        $message = $approve == config('common.posts.approve_key.approved')
            ? "Phê duyệt bài viết $dataApprove->title thành công."
            : "Bài viết $dataApprove->title đã bị từ chối";

        $request->session()->flash('success', $message);

        return redirect()->route('admin.post.approveList');
    }
}
