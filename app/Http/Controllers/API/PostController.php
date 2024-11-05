<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('category', 'tags');            // Eager loading

        $titleParam = request()->input('title');
        if (isset($titleParam)) {
            $posts = $posts->where('title', 'LIKE', '%'.$titleParam.'%');
        }

        $posts = $posts->paginate(3);                       // Paginazione

        return response()->json([
            'success' => true,
            'code' => 200,
            // 'message' => 'Ok',
            'posts' => $posts
        ]);
    }

    public function show(string $slug)
    {
        $post = Post::with('category', 'tags')
                    ->where('slug', $slug)
                    ->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'code' => 200,
                // 'message' => 'Ok',
                'post' => $post
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'Post not found'
            ]);
        }
    }

}
