<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Helpers
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\{
    Post,
    Category,
    Tag
};

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

        $data['slug'] = str()->slug($data['title']);
        $data['published'] = isset($data['published']);

        if (isset($data['cover'])) {
            $coverPath = Storage::disk('public')->put('uploads', $data['cover']);
            $data['cover'] = $coverPath;
        }

        $post = Post::create($data);

        if (isset($data['tags'])) {
            foreach ($data['tags'] as $tagId) {
                $post->tags()->attach($tagId);
            }

            /* OPPURE */

            // $post->tags()->sync($data['tags']);
        }

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
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3|max:4096',
            'cover' => 'nullable|image|max:2048',
            'likes' => 'nullable|integer|min:0|max:1000',
            'published' => 'nullable|in:1,0,true,false',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array|exists:tags,id',
            'remove_cover' => 'nullable',
        ], [
            'title.required' => 'Il titolo del post è obbligatorio',
            'published.in' => 'Hai provato ad imbrogliare eh? Furbettino',
            'category_id.exists' => 'Categoria non valida',
        ]);

        $data['slug'] = str()->slug($data['title']);
        $data['published'] = isset($data['published']);

        /*

            Operazioni possibili su cover:
            1) Se c'è già un'immagine, la posso sostituire
            2) Se non c'è già un'immagine, la posso aggiungere
            3) Se c'è un'immagine, la posso rimuovere

        */
        if (isset($data['cover'])) {
            if ($post->cover) {
                // ELIMINA L'IMMAGINE PRECEDENTE
                Storage::disk('public')->delete($post->cover);
                $post->cover = null;
            }

            $coverPath = Storage::disk('public')->put('uploads', $data['cover']);
            $data['cover'] = $coverPath;
        }
        else if (isset($data['remove_cover']) && $post->cover) {
            // ELIMINA L'IMMAGINE PRECEDENTE
            Storage::disk('public')->delete($post->cover);
            $post->cover = null;
        }

        $post->update($data);

        /*
            1. rimuovi tutte le associazioni con i tag NON più presenti nell'array $data['tags']
            2. aggiungi tutte le associazioni con i tag che PRIMA non c'erano e ora sono in $data['tags']
            3. preserva quelle esistenti che sono ancora in $data['tags']
        */
        // if (!isset($data['tags'])) {
        //     $data['tags'] = [];
        // }
        // $post->tags()->sync($data['tags']);

        /*
            1) Leggo tutti i tag attualmente associati (magari, mi creo un array di id di tag associati)
            2) Confronto la lista dei tag attualmente associati con la lista dei tag selezionati in fase di sottomissione del form di edit -> Per ogni elemento delle due liste:
                - Se il tag esiste nelle due liste, non faccio niente
                - Se il tag esiste nella NUOVA lista, ma non nella vecchia -> faccio l'attach() del nuovo tag
                - Se il tag esiste nella VECCHIA lista, ma non nella nuova -> faccio il detach() del vecchio tag

            Questo lo farei così:

            ciclo su quelli vecchi
                per ogni elemento vecchio vedo se si trova in $data['tags']
                se non si trova in $data['tags'] -> detach

            ciclo sui nuovi
                per ogni elemento nuovo vedo se è già associato
                se non è già associato -> attach
        */

        $post->tags()->sync($data['tags'] ?? []);

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->cover) {
            // ELIMINA L'IMMAGINE PRECEDENTE
            Storage::disk('public')->delete($post->cover);
        }

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
