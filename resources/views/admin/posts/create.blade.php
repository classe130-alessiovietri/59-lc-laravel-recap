@extends('layouts.app')

@section('page-title', 'Crea post')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Crea post
                    </h1>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())

        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>

    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required minlength="3" maxlength="255" value="{{ old('title') }}" placeholder="Inserisci il titolo...">
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Contenuto <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" minlength="3" maxlength="4096" required rows="3" placeholder="Inserisci il contenuto...">{{ old('content') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="cover" class="form-label">Immagine di copertina</label>
                            <input type="file" class="form-control" id="cover" name="cover" placeholder="Scegli un'immagine di copertina...">
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoria</label>
                            <select id="category_id" name="category_id" class="form-select">
                                <option
                                    @if (old('category_id') == null)
                                        selected
                                    @endif
                                    value="">Seleziona una categoria...</option>
                                @foreach ($categories as $category)
                                    <option
                                        @if (old('category_id') == $category->id)
                                            selected
                                        @endif
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <div>
                                <label class="form-label">Tag</label>
                            </div>
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <input
                                        @if (in_array($tag->id, old('tags', [])))
                                            checked
                                        @endif
                                        class="form-check-input"
                                        type="checkbox"
                                        id="tag-{{ $tag->id }}"
                                        name="tags[]"
                                        value="{{ $tag->id }}">
                                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="row align-items-end g-3 mb-3">
                            <div class="col">
                                <div>
                                    <label for="likes" class="form-label"># mi piace</label>
                                    <input type="number" class="form-control" id="likes" name="likes" value="0" step="1" min="0" max="1000" value="{{ old('likes') }}" placeholder="Inserisci il # di mi piace...">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="published" name="published"
                                            @if (old('published') !== null)
                                                checked
                                            @endif
                                        >
                                    <label class="form-check-label" for="published">
                                        Pubblicato
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-success w-100">
                                + Aggiungi
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
