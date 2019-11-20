<?php

namespace App\Repositories\Post;

use App\Jobs\SendMailApprovePost;
use App\Jobs\SendMailDeletePost;
use App\Mail\Posts\ApprovePost;
use App\Models\Post;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Session;

class PostRepository extends EloquentRepository
{
    public function getModel()
    {
        return Post::class;
    }

    public function searchPost($input)
    {
        $paginate = config('common.pagination.default');
        $language = Session::get('locale');
        $title = $input['title'] ?? null;
        $approve = $input['approve'] ?? 'null';
        $isRequestEdited = $input['request_edited'] ?? null;
        $user = Auth::user();

        $whereConditional = [
            ['title', 'like', '%' . $title . '%'],
            ['lang_id', $language],
            !is_string($approve) ? ['approve', $approve] : ['id', '>', 0],
            $isRequestEdited != null ? ['edited_from', '<>', null] : ['edited_from', null],
            $user->role_id <= config('common.roles.super_admin') ? ['id', '>', 0] : ['posted_by', $user->id]
        ];

        $result = $this->_model->where($whereConditional)
            ->with('category', 'postedBy', 'approveBy', 'parentTranslate', 'parentEdited')
            ->get();

        return $result;
    }

    public function insertPost($input)
    {
        $input['image'] = uploadImage('posts', $input['image']);

        $result = $this->_model->create($input);

        return $result;
    }

    public function editPost($id, $input)
    {
        $result = $this->find($id);

        if (isset($input['image']) && !is_string($input['image'])) $input['image'] = uploadImage('posts', $input['image']);

        $result->update($input);

        if (isset($input['image']) || isset($input['category_id'])) {
            $dataUpdate = [
                'category_id' => $result->category_id,
                'image' => $result->image
            ];
            $result->childrenTranslate()->update($dataUpdate);
        }

        return $result;
    }

    public function editFromApprovedPost($id, $input)
    {
        $result = $this->find($id);

        $dataEditPost = $result->toArray();
        $input['edited_from'] = $id;
        $input['id'] = null;
        $input['posted_by'] = Auth::user()->id;
        $input['lang_id'] = config('common.languages.default');
        $input['lang_parent_id'] = $dataEditPost['lang_parent_id'];
        !isset($input['image']) ? $input['image'] = $dataEditPost['image'] : $input['image'] = uploadImage('posts', $input['image']);

        return $this->_model->create($input);
    }

    public function getPostById($id)
    {
        $user = Auth::user();

        $whereConditional = [
            ['id', $id],
            $user->role_id <= config('common.roles.admin') ? ['id', '>', 0] : ['posted_by', $user->id]
        ];

        return $this->_model->where($whereConditional)
            ->with('language', 'childrenTranslate.language', 'parentTranslate.language', 'postedBy')->first();
    }

    public function findEditedPost($id)
    {
        $user = Auth::user();

        $whereConditional = [
            ['id', $id],
            $user->role_id <= config('common.roles.admin') ? ['id', '>', 0] : ['posted_by', $user->id]
        ];

        return $this->_model->where($whereConditional)->with('editedFrom', 'parentEdited', 'category.childrenTranslate', 'childrenTranslate', 'parentTranslate', 'postedBy')->first();
    }

    public function deletePost($result)
    {
        $result->childrenTranslate()->delete();

        $result->editedFrom()->delete();

        $result->delete();

        return !!$result;
    }

    public function translate($id, $input)
    {
        $post = $this->find($id);

        $input['lang_parent_id'] = $id;

        $input['image'] = $post->image;

        $result = $this->_model->create($input);

        return $result;
    }

    public function checkUniqueTitle($input)
    {
        $title = $input['title'];
        $langId = $input['lang_id'];

        $whereConditional = [
            ['title', $title],
            ['lang_id', $langId]
        ];

        $result = $this->_model->where($whereConditional)->get();

        return $result;
    }

    public function approvePost($result, $input)
    {
        $input['approve_by'] = Auth::user()->id;

        $input['approve'] == config('common.posts.approve_key.reject') && $input['message_reject'] != null
            ? $input['message_reject'] = $input['message_reject'] ?? 'Rejected'
            : null;

        if ($input['approve'] == -1) {
            $result->childrenTranslate()->update([
                'approve' => $input['approve'],
                'message_reject' => $input['message_reject'],
                'approve_by' => $input['approve_by'],
            ]);
        }

        $result->update($input);

        return $result;
    }

    public function approveFromPostApproved($post)
    {
        $dataPost = $post->toArray();

        $id = $dataPost['parent_edited']['id'];
        $input = $dataPost;
        $input['approve_by'] = Auth::user()->id;

        if ($dataPost['approve'] == config('common.posts.approve_key.approved')) {

            $result = $this->update($id, $input);

            $this->delete($dataPost['id']);
        } else {
            $result = $this->update($dataPost['id'], $dataPost);
        }

        return $result;
    }

    public function getClientPost()
    {
        $paginate = config('common.pagination.default');
        $language = Session::get('locale');

        $whereConditional = [
            ['lang_id', $language],
            ['edited_from', null],
            ['approve', config('common.posts.approve_key.approved')],
        ];

        return $this->_model->where($whereConditional)->with('postedBy')->orderBy('id', 'desc')->paginate($paginate);
    }

    public function clientDetail($id)
    {
        $language = Session::get('locale');

        return $this->_model->where('id', $id)->where('lang_id', $language)->with('postedBy')->first();
    }

    public function postsSameCategory($data)
    {
        $language = Session::get('locale');
        $categoryId = $data->category_id;
        $currentPostId = $data->id;

        $whereConditional = [
            ['lang_id', $language],
            ['category_id', $categoryId],
            ['edited_from', null],
            ['approve', config('common.posts.approve_key.approved')],
            ['id', '<>', $currentPostId],
        ];

        return $this->_model->where($whereConditional)->with('postedBy')->get();
    }

    public function getClientPostViaCategoryName($name)
    {
        $language = Session::get('locale');
        $paginate = config('common.pagination.default');

        $whereConditional = [
            ['lang_id', $language],
            ['edited_from', null],
            ['approve', config('common.posts.approve_key.approved')],
        ];

        $result = $this->_model->where($whereConditional)->with('category')
            ->whereHas('category', function ($query) use ($name, $language) {
                $categoryWhereConditional = [
                    ['name', $name],
                    ['type', 0],
                ];

                $query->where($categoryWhereConditional);
            })->orderBy('id', 'desc')->paginate($paginate);

        return $result;
    }

    public function getRandomPost()
    {
        $language = Session::get('locale');
        $approve = config('common.posts.approve_key.approved');

        return $this->_model->where('approve', $approve)->where('lang_id', $language)->orderBy(DB::raw('RAND()'))->limit(5)->get();
    }

    public function sendMailApprovePost($data)
    {
        SendMailApprovePost::dispatch($data);
    }

    public function sendMailDeletePost($data, $messageDelete)
    {
        SendMailDeletePost::dispatch($data, $messageDelete);
    }
}
