<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\{
    Post,
    Category
};

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3|max:4096',
            'cover' => 'nullable|min:5|max:2048|url',
            'likes' => 'nullable|integer|min:0|max:1000',
            'published' => 'nullable|in:1,0,true,false',
            'category_id' => 'nullable|exists:categories,id',
        ], [
            'title.required' => 'Il titolo del post è obbligatorio',
            'published.in' => 'Hai provato ad imbrogliare eh? Furbettino',
            'category_id.exists' => 'Categoria non valida',
        ]);

        $data['slug'] = str()->slug($data['title']);
        $data['published'] = isset($data['published']);

        $post = Post::create($data);

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3|max:4096',
            'cover' => 'nullable|min:5|max:2048|url',
            'likes' => 'nullable|integer|min:0|max:1000',
            'published' => 'nullable|in:1,0,true,false',
        ], [
            'title.required' => 'Il titolo del post è obbligatorio',
            'published.in' => 'Hai provato ad imbrogliare eh? Furbettino'
        ]);

        $data['slug'] = str()->slug($data['title']);
        $data['published'] = isset($data['published']);

        $post->update($data);

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
