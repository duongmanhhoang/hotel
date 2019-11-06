<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\EloquentRepository;

class CommentRepository extends EloquentRepository
{

    public function getModel()
    {
        return Comment::class;
    }

    public function makeRules()
    {
        return [
            'email' => 'required|email|max:191',
            'body' => 'required',
            'star' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '',
            'email.email' => '',
            'email.max' => '',
            'body.required' => '',
            'star.required' => ''
        ];
    }

}