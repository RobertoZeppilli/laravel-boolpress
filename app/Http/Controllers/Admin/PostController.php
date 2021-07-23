<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(4);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {   
        $slug = $request->get('title');

        $request->request->add([
            "slug" => Str::slug($slug ,'-')
        ]);

        $request->validate(
            [
                "title" => "required|max:255",
                "slug" => "unique:posts",
                "body" => "required|max:65535"
            ],
            [
                "required" => ":attribute is required!",
                "slug.unique" => "The slug must be unique!",
                "max" => ":attribute cannot be much longer!"
            ]
        );

        $post = new Post();

        $post->fill($request->all());

        $post->save();

        return redirect()
        ->route('admin.posts.show', $post->id)
        ->with('message', 'New post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $slug = $request->get('title');

        $request->request->add([
            'slug' => Str::slug($slug, '-')
        ]);

        $request->validate(
            [
                "title" => "required|max:255",
                "slug" => [
                    Rule::unique('posts')->ignore($post->id)
                ],
                "body" => "required|max:65535"
            ],
            [
                "required" => ":attribute is required!",
                "slug.unique" => "The slug must be unique!",
                "max" => ":attribute cannot be much longer!"
            ]
        );

        $post->update($request->all());

        return redirect()
        ->route('admin.posts.show', $post->id)
        ->with('message', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('message', 'Post deleted!');
    }
}
