<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        return view('admin.comments.index');
    }

    public function datatable()
    {
        $comments = $this->commentRepository->getDataTable();

        return response()->json(['data' => $comments], 200);
    }

    public function show($id)
    {
        $comment = $this->commentRepository->getComment($id);

        if ($comment) {
            $dataResponse = [
                'messages' => 'success',
                'data' => $comment,
            ];
        } else {
            $dataResponse = [
                'messages' => 'fail'
            ];
        }

        return response()->json($dataResponse, 200);
    }

    public function delete($id)
    {
        $this->commentRepository->delete($id);

        return response()->json(['messages' => 'success'], 200);
    }
}
