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
                // 'code' => 200,
                // 'message' => 'Ok',
                'post' => $post
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                // 'code' => 404,
                'message' => 'Post not found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3|max:4096',
            'cover' => 'nullable|image|max:2048',
            'likes' => 'nullable|integer|min:0|max:1000',
            'published' => 'nullable|in:1,0,true,false',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array|exists:tags,id',
        ], [
            'title.required' => 'Il titolo del post è obbligatorio',
            'published.in' => 'Hai provato ad imbrogliare eh? Furbettino',
            'category_id.exists' => 'Categoria non valida',
        ]);

        // 1) Valido i campi -> teoricamente, NON va bene la modalità di validazione che conosciamo, perché quella fa il redirect
                        //   -> se la validazione NON va a buon fine, che tipo di info gli restituisco
        // 2) Creo il nuovo post con i dati passati dal frontend
        // 3) Do un messaggio di risposta -> in che forma? cosa gli voglio restituire?

        return response()->json([
            'success' => true,
            'data' => $request->all()
        ]);
    }

}
