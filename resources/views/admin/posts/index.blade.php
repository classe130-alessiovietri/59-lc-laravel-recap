@extends('layouts.app')

@section('page-title', 'Tutti i post')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tutti i post
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success w-100">
                + Aggiungi
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titolo</th>
                                <th scope="col" class="text-center">Categoria</th>
                                <th scope="col" class="text-center">Tag</th>
                                <th scope="col" class="text-center"># mi piace</th>
                                <th scope="col" class="text-center">Pubblicato</th>
                                <th scope="col" class="text-center">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td class="text-center">
                                        @if (isset($post->category))
                                            <a href="{{ route('admin.categories.show', ['category' => $post->category_id]) }}">
                                                {{ $post->category->name }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @forelse($post->tags as $tag)
                                            <a href="{{ route('admin.tags.show', ['tag' => $tag->id]) }}" class="badge rounded-pill text-bg-primary">
                                                {{ $tag->name }}
                                            </a>
                                        @empty
                                            -
                                        @endforelse
                                    </td>
                                    <td class="text-center">{{ number_format($post->likes, 0, '', '.') }}</td>
                                    <td class="text-center">{{ $post->published ? 'SI' : 'NO' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary btn-sm">
                                            Vedi
                                        </a>
                                        <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-warning btn-sm">
                                            Modifica
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post" class="d-inline-block"
                                            onsubmit="return confirm('Sei sicur* di voler eliminare questo post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Elimina
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
