@extends('layouts.app')

@section('page-title', $post->title)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $post->title }}
                    </h1>
                    <h6 class="text-center">
                        Creato il: {{ $post->created_at->format('d/m/Y') }}
                        <br>
                        alle: {{ $post->created_at->format('H:i') }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col text-end">
            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-warning">
                Modifica
            </a>
            <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post" class="d-inline-block"
                onsubmit="return confirm('Sei sicur* di voler eliminare questo post?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Elimina
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li>
                            ID: {{ $post->id }}
                        </li>
                        <li>
                            Slug: {{ $post->slug }}
                        </li>
                        <li>
                            # mi piace: {{ number_format($post->likes, 0, '', '.') }}
                        </li>
                        <li>
                            Pubblicato: {{ $post->published ? 'SI' : 'NO' }}
                        </li>
                        <li>
                            Categoria collegata:

                            @if (isset($post->category))
                                <a href="{{ route('admin.categories.show', ['category' => $post->category_id]) }}">
                                    {{ $post->category->name }}
                                </a>
                            @else
                                -
                            @endif
                        </li>
                        <li>
                            Tag collegati:

                            @if ($post->tags()->count() > 0)
                                <ul>
                                    @foreach ($post->tags as $tag)
                                        <li>
                                            <a href="{{ route('admin.tags.show', ['tag' => $tag->id]) }}" class="badge rounded-pill text-bg-primary">
                                                {{ $tag->name }}
                                            </a>
                                            <small>
                                                (associazione creata il {{ $tag->pivot->created_at->format('d/m/Y') }})
                                            </small>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                -
                            @endif
                        </li>
                    </ul>

                    <p>
                        {!! nl2br($post->content) !!}
                    </p>
                </div>
                @if ($post->cover)
                    <img src="{{ '/storage/'.$post->cover }}" alt="{{ $post->title }}" class="card-img-bottom">
                    <img src="{{ asset('storage/'.$post->cover) }}" alt="{{ $post->title }}" class="card-img-bottom">
                @endif
            </div>
        </div>
    </div>
@endsection
