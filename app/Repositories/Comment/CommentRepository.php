<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Models\Room;
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
            'rating' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('messages.validation.email_required'),
            'email.email' => __('messages.validation.email_email'),
            'email.max' => __('messages.validation.email_max'),
            'body.required' => __('messages.validation.body_required'),
            'rating.required' => __('messages.validation.star_required'),
        ];
    }

    public function storeData($data, $id)
    {
        $comment = $this->_model->create($this->makeData($data, $id));
        $newRating = $this->updateRoomRating($data['rating'], $id);

        return [
            'comment' => $comment,
            'newRating' => $newRating,
        ];
    }

    protected function makeData($data, $id)
    {
        return [
            'commentable_type' => Room::class,
            'commentable_id' => $id,
            'email' => $data['email'],
            'body' => $data['body'],
            'rating' => $data['rating'],
        ];
    }

    protected function updateRoomRating($rating, $id)
    {
        $room = Room::find($id);
        $oldRating = $room->rating;
        $newRating = round((($rating + $oldRating) / 2), 1);
        $room->update(['rating' => $newRating]);

        return $newRating;
    }

    public function getCommentsByRoom($id)
    {
        return $this->_model->where('commentable_type', Room::class)->where('commentable_id', $id)->orderBy('id', 'desc')->get();
    }

    public function getDataTable()
    {
        $comments = $this->_model->with('commentable.roomName')->orderBy('id', 'desc')->get();
        foreach ($comments as $comment) {
            $roomName = $comment->commentable->roomName;
            $comment->roomName = $roomName->name;
        }

        return $comments;
    }

  public function getComment($id)
  {
        $comment = $this->_model->find($id);

        if (!$comment) {
            return false;
        }

        $comment->roomName = $comment->commentable->roomName->name;

        return $comment;
  }
}
