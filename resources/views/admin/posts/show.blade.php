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
                        Creato il: {{ $post->created_at->format('H:i d/m/Y') }}
                    </h6>
                </div>
            </div>
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
                    </ul>


                    <p>
                        {{ $post->content }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
