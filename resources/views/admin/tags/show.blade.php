@extends('layouts.app')

@section('page-title', $tag->name)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $tag->name }}
                    </h1>
                    <h6 class="text-center">
                        Creato il: {{ $tag->created_at->format('d/m/Y') }}
                        <br>
                        alle: {{ $tag->created_at->format('H:i') }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col text-end">
            <a href="{{ route('admin.tags.edit', ['tag' => $tag->id]) }}" class="btn btn-warning">
                Modifica
            </a>
            <form action="{{ route('admin.tags.destroy', ['tag' => $tag->id]) }}" method="post" class="d-inline-block"
                onsubmit="return confirm('Sei sicur* di voler eliminare questo tag?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Elimina
                </button>
            </form>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li>
                            ID: {{ $tag->id }}
                        </li>
                        <li>
                            Slug: {{ $tag->slug }}
                        </li>
                        <li>
                            Post collegati:

                            @if ($tag->posts()->count() > 0)
                                <ul>
                                    @foreach ($tag->posts as $post)
                                        <li>
                                            <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}">
                                                {{ $post->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                nessun post collegato
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
