<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Tag;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $validation = [
        "title" => "required|max:255",
        "body" => "required|max:65535",
        "category_id" => "nullable|exists:categories,id",
        "tags" => "exists:tags,id",
        "cover" => "nullable|mimes:jpeg,jpg,png,svg|max:2048"
    ];
    private $validationMsg = [
        "required" => ":attribute is required!"
    ];

    private function createSlug($data)
    {
        $slug = Str::slug($data["title"], "-");
        $postExists = Post::where('slug', $slug)->first();

        $starterSlug = $slug;
        $counter = 1;

        while ($postExists) {
            $slug = $starterSlug . '-' . $counter;

            $postExists = Post::where('slug', $slug)->first();
            $counter++;
        }

        return $slug;
    }
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
    public function create(Category $category)
    {

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {

        $data = $request->all();

        $request->validate($this->validation, $this->validationMsg);

        $post = new Post();

        $slug = $this->createSlug($data);
        $data['slug'] = $slug;

        if (array_key_exists('cover', $data)) {
            $data['cover'] = Storage::put('covers', $data['cover']);
        }

        $post->fill($data);

        $post->save();

        if (array_key_exists('tags', $data)) {
            $post->tags()->attach($data['tags']);
        }

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

        $categories = Category::all();

        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
        $data = $request->all();

        $request->validate($this->validation, $this->validationMsg);

        if ($post->title != $data['title']) {
            $slug = $this->createSlug($data);
            $data['slug'] = $slug;
        }

        if (array_key_exists('cover', $data)) {
            if ($post->cover) {
                Storage::delete($post->cover);
            }

            $data['cover'] = Storage::put('covers', $data['cover']);
        }

        $post->update($data);

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

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
        if($post->cover) {
            Storage::delete($post->cover);
        }
        
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('message', 'Post deleted!');
    }
}
