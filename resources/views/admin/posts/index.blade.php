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
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titolo</th>
                                <th scope="col"># mi piace</th>
                                <th scope="col">Pubblicato</th>
                                <th scope="col">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td class="text-center">{{ number_format($post->likes, 0, '', '.') }}</td>
                                    <td class="text-center">{{ $post->published ? 'SI' : 'NO' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary btn-sm">
                                            Vedi
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
