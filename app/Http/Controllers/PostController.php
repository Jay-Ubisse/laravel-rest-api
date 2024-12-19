<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return ["message" => "ok", "data" => $posts];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            "title" => "required | max:255",
            "body" => "required",
            "author" => "required | max:100"
        ]);

        $post = Post::create($fields);
        return ["message" => "Post created sucessfully", "data" => $post];
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return ["message" => "ok", "data" => $post];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $fields = $request->validate([
            "title" => "required | max:255",
            "body" => "required",
            "author" => "required | max:100"
        ]);

        $post->update($fields);

        return ["message" => "Post updated sucessfully", "data" => $post];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return ["message" => "Post deleted  sucessfully"];
    }
}
