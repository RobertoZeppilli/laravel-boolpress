<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(3);

        foreach ($posts as $post) {
            if ($post->cover) {
                $post->cover = url('storage/' . $post->cover);
            } else {
                $post->cover = url('images/ph.jpg');
            }
        }

        return response()->json($posts);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (!empty($post)) {
            if ($post->cover) {
                $post->cover = url('storage/' . $post->cover);
            } else {
                $post->cover = url('images/ph.jpg');
            }
        }

        return response()->json($post);
    }
}
