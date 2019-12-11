<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Post\PostRepository;
use Auth;
use Illuminate\Http\Request;
use Session;

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

    public function index()
    {
        $user = Auth::user();

        $countStatusPosts = $this->postRepo->countStatusPosts();

        return view('admin.posts.index', compact('user', 'countStatusPosts'));
    }

    public function dataTable(Request $request, $status = 'approved')
    {
        $input = $request->all();
        $approveStatus = config("common.posts.approve_key.$status");
        $user = Auth::user();

        $input['title'] = $input['title'] ?? null;
        $input['approve'] = $approveStatus;

        if ($status == 'request-edited') {
            $input['approve'] = null;
            $input['request_edited'] = true;
        }

        $data = $this->postRepo->searchPost($input);
        $data['user'] = $user;

        return response()->json([
            'data' => $data
        ]);
    }

    public function addView($postId = false)
    {
        $user = Auth::user();

        if ($postId != false) {
            $checkAvailableTranslate = $this->postRepo->find($postId);

            if ($checkAvailableTranslate == null) return redirect()->back()->with(['error' => 'Không tìm thấy dữ liệu']);

            if ($checkAvailableTranslate->lang_parent_id != null)
                return redirect()->back()->with(['error' => 'Chỉ được dịch từ bài viết gốc']);

            if ($checkAvailableTranslate->postedBy->id != $user->id)
                return redirect()->back()->with(['error' => 'Không tìm thấy dữ liệu']);
        }

        $categories = $this->categoryRepo->getCategory(null);
        $route = $postId != false ? route('admin.post.translateAction', $postId) : route('admin.post.addAction');
        $posts = $this->postRepo->searchPost(null);
        $dataTranslate = $postId != false ? true : null;
        $language = $postId != false ? $this->postRepo->getTranslateId($postId) : [];

        if ($postId != false && count($language) <= 0)
            return redirect()->back()->with(['error' => 'Đã đủ bản dịch']);

        $compact = compact('categories', 'route', 'posts', 'language', 'dataTranslate');

        return view('admin.posts.add', $compact);
    }

    public function store(PostRequest $request)
    {
        $input = $request->all();
        $input['lang_id'] = $this->baseLang;
        $input['posted_by'] = Auth::user()->id;

        $checkUnique = $this->postRepo->checkUniqueTitle($input);

        if (count($checkUnique) > 0) {
            return redirect()->back()->with(['error' => 'Tiêu đề đã tồn tại']);
        }

        $this->postRepo->insertPost($input);

        $request->session()->flash('success', 'Thêm bài viết thành công');

        return redirect()->route('admin.post.list', ['status' => config('common.posts.approve_value.0')]);
    }

    public function editView($id)
    {
        $data = $this->postRepo->findEditedPost($id);
        $categories = $this->categoryRepo->getCategory(null);
        $route = route('admin.post.editAction', ['id' => $id]);
        $user = Auth::user();

        if ($data == null) {
            return redirect()->back()->with(['error' => 'Không tìm thấy dữ liệu']);
        }

        if ($data->postedBy->id != $user->id) {
            return redirect()->back()->with(['error' => 'Không tìm thấy dữ liệu']);
        }

        $compact = compact('categories', 'route', 'data');

        return view('admin.posts.add', $compact);
    }

    public function postEdit(Request $request, $id)
    {
        $input = $request->all();
        $user = Auth::user();

        $dataToEdit = $this->postRepo->findEditedPost($id);

        if ($dataToEdit->postedBy->id != $user->id) {
            return redirect()->back()->with(['error' => 'Không được sửa bài viết của người khác']);
        }

        if ($dataToEdit->editedFrom) {
            $id = $dataToEdit->editedFrom->id;
            $dataToEdit = $dataToEdit->editedFrom;
        }

        if ($dataToEdit->approve != config('common.posts.approve_key.pending')) {
            $this->postRepo->editFromApprovedPost($id, $input);

            $request->session()->flash('success', 'Tạo mới từ bài viết đã được phê duyệt');
            return redirect()->route('admin.post.list');
        }

        $this->postRepo->editPost($dataToEdit, $input);

        $message = 'Cập nhật thành công';

        $request->session()->flash('success', $message);

        return redirect()->route('admin.post.list');
    }

    public function delete(Request $request, $id)
    {
        $input = $request->all();
        $user = Auth::user();

        $data = $this->postRepo->findEditedPost($id);

        if ($data == null) {
            return response()->json([
                'is_deleted' => false,
                'message' => 'Không tìm thấy dữ liệu'
            ]);
        }

        $dataToSendMail = $data;

        if ($data->posted_by != $user->id) {
            if ($input['admin_delete'] == 'admin_delete') {
                if (empty($input['message_deleted'])) {
                    return response()->json(['is_deleted' => false,
                        'message' => 'Không được bỏ trống lí do tại sao xóa'
                    ]);
                }

                $this->postRepo->sendMailDeletePost($dataToSendMail, $input['message_deleted']);
            }
        }

        $this->postRepo->deletePost($data);

        return response()->json(['is_deleted' => true]);
    }

    public function detailPost($id)
    {
        $data = $this->postRepo->getPostById($id);
        $user = Auth::user();

        if ($data == null) {
            return redirect()->back()->with(['error' => 'Không tìm thấy dữ liệu']);
        }

        $idToGetTranslate = $data->parentTranslate == null ? $id : $data->parentTranslate->id;

        $translatePosts = $this->postRepo->getAllTranslatePosts($idToGetTranslate);

        return view('admin.posts.detail', compact('data', 'user', 'translatePosts'));
    }

    public function translate(Request $request, $postId)
    {
        $input = $request->all();
        $user = Auth::user();
        $input['posted_by'] = $user->id;

        $currentPost = $this->postRepo->findEditedPost($postId);

        if ($currentPost->postedBy->id != $user->id) {
            return redirect()->back()->with(['error' => 'Không được dịch bài viết của người khác']);
        }

        if ($currentPost->approve == config('common.posts.approve_key.rejected'))
            return redirect()->back()->with(['error' => 'Không được dịch từ bài viết đã bị từ chối']);

        $checkUnique = $this->postRepo->checkUniqueTitle($input);

        if (count($checkUnique) > 0) {
            return redirect()->back()->with(['error' => 'Tiêu đề đã tồn tại']);
        }

        if ($currentPost->category != null) {
            foreach ($currentPost->category->childrenTranslate as $value) {
                if ($value->lang_id == $input['lang_id']) {
                    $input['category_id'] = $value->id;
                }
            }
        }

        if (empty($input['category_id'])) return redirect()->back()->with(['error' => 'Danh mục phải có bản dịch']);

        $this->postRepo->translate($postId, $input);

        $request->session()->flash('success', 'Dịch thành công');
        Session::put('locale', $input['lang_id']);

        return redirect()->route('admin.post.list', 'pending');
    }

    public function getApproveList(Request $request, $status = 'pending')
    {
        $input = $request->all();
        $input['approve'] = config("common.posts.approve_key.$status");
        $user = Auth::user();

        if ($status == 'request-edited') {
            $input['approve'] = null;
            $input['request_edited'] = true;
        }

        $input['title'] = $input['title'] ?? null;

        $request->session()->put('params.search.post_title', $input['title']);
        $titleSearch = $input['title'];

        $data = $this->postRepo->searchPost($input);
        $countStatusPosts = $this->postRepo->countStatusPosts();

        return view('admin.posts.approve', compact('data', 'titleSearch', 'countStatusPosts', 'user'));
    }

    public function approvingPost(Request $request, $id, $approve)
    {
        $input = $request->all();

        $user = Auth::user();

        if ($user->role_id > config('common.roles.admin')) {
            return redirect()->back()->with(['error' => 'Bạn không có quyền duyệt']);
        }

        if ($approve == -1 && empty($input['message_reject'])) {
            return redirect()->back()->with(['error' => 'Không được bỏ trống lí do từ chối']);
        }

        $checkPost = $this->postRepo->findEditedPost($id);

        if ($checkPost->parentTranslate && $checkPost->parentTranslate->approve == -1) {
            return redirect()->back()->with(['error' => 'Bản gốc đang bị từ chối']);
        }

        if ($checkPost->parentEdited) {
            $checkPost->approve = $approve;
            $checkPost->message_reject = $input['message_reject'];
            $dataApprove = $this->postRepo->approveFromPostApproved($checkPost);
        } else {
            $input['approve'] = $approve;

            $dataApprove = $this->postRepo->approvePost($checkPost, $input);
        }

        $this->postRepo->sendMailApprovePost($dataApprove);

        $message = $approve == config('common.posts.approve_key.approved')
            ? "Bài viết $dataApprove->title đã được phê duyệt"
            : "Bài viết $dataApprove->title đã bị từ chối";

        $request->session()->flash('success', $message);

        return redirect()->back();
    }

    public function approveSelected(Request $request)
    {
        $input = $request->all();

        $input['arrayId'] = $input['arrayId'] ?? [];

        if(empty($input['arrayId'])) return 'empty';

        $data = $this->postRepo->approveSelectedPosts($input);

        return response()->json(['data' => $data]);
    }
}
