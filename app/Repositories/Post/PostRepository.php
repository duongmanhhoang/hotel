<?php

namespace App\Repositories\Post;

use App\Repositories\EloquentRepository;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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

        $whereConditional = [
            ['title', 'like', '%' . $title . '%'],
            ['lang_id', $language],
            !is_string($approve) ? ['approve', $approve] : ['id', '>', 0]
        ];

        $result = $this->_model->where($whereConditional)
            ->with('category', 'postedBy', 'approveBy', 'parentTranslate')
            ->paginate($paginate);

        return $result;
    }

    public function getPostById($id)
    {
        $result = $this->_model->where('id', $id)->with('category')->first();

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

        if(isset($input['image'])) $input['image'] = uploadImage('posts', $input['image']);

        $result->update($input);

        if(isset($input['image']) || isset($input['category_id'])) {
            $dataUpdate = [
                'category_id' => $result->category_id,
                'image' => $result->image
            ];
            $result->childrenTranslate()->update($dataUpdate);
        }

        return $result;
    }

    public function deletePost($id)
    {
        $result = $this->find($id);

        $result->childrenTranslate()->delete();

        $result->delete();

        return !!$result;
    }

    public function translate($id, $input)
    {
        $post = $this->find($id);

        $input['lang_parent_id'] = $id;

        $input['image'] = $post->image;

        $input['category_id'] = $post->category_id;

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

    public function approvePost($id, $approve)
    {
        $result = $this->find($id);

        $input['approve'] = $approve;

        $input['approve_by'] = Auth::user()->id;

        $approve == config('common.posts.approve_key.reject') ? $input['message'] = $input['message'] ?? 'Rejected' : null;

        $result->update($input);

        return $result;
    }
}
