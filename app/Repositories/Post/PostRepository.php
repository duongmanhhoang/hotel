<?php

namespace App\Repositories\Post;

use App\Repositories\EloquentRepository;
use App\Models\Post;
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
        $title = $input['title'];

        $whereConditional = [
            ['title', 'like', '%' . $title . '%'],
            ['lang_id', $language]
        ];

        $result = $this->_model->where($whereConditional)->with('category', 'postedBy', 'approveBy')->paginate($paginate);

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
            $result->childrenPost()->update($dataUpdate);
        }

        return $result;
    }

    public function deletePost($id)
    {
        $result = $this->find($id);

        $result->childrenPost()->delete();

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
}
