<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepository;

class PostController extends Controller
{
    protected $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->getPostByLimit(10);
      //  dd($posts);
        return view('front.posts', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->post->find($id);
        return view('front.post', compact('post'));
    }
}
