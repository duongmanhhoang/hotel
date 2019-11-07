<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Post\PostRepository;

class PostController extends Controller
{

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepo = $postRepository;
    }

    public function index()
    {
        $data = $this->postRepo->getClientPost();

        return view('client.blog.index', compact('data'));
    }

    public function detail($id)
    {
        $data = $this->postRepo->clientDetail($id);

        if (empty($data)) return redirect()->route('post.index')->with(['error' => 'Không tìm thấy bài viết']);

        $sameCategory = $this->postRepo->postsSameCategory($data);

        return view('client.blog.blog_detail', compact('data', 'sameCategory'));
    }

    public function getPostViaCategoryName($name)
    {
        $data = $this->postRepo->getClientPostViaCategoryName($name);


        return view('client.blog.index', compact('data'));
    }
}
