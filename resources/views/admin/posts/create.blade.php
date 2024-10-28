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
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.posts.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required minlength="3" maxlength="255" placeholder="Inserisci il titolo...">
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Contenuto <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" minlength="3" maxlength="4096" required rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="cover" class="form-label">Immagine di copertina</label>
                            <input type="text" class="form-control" id="cover" name="cover" minlength="5" maxlength="2048" placeholder="Inserisci il link dell'immagine di copertina...">
                        </div>

                        <div class="row align-items-end g-3 mb-3">
                            <div class="col">
                                <div>
                                    <label for="likes" class="form-label"># mi piace</label>
                                    <input type="number" class="form-control" id="likes" name="likes" value="0" step="1" min="0" max="1000" placeholder="Inserisci il # di mi piace...">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="published" name="published">
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
