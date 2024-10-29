@extends('layouts.app')

@section('page-title', $category->name)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $category->name }}
                    </h1>
                    <h6 class="text-center">
                        Creata il: {{ $category->created_at->format('d/m/Y') }}
                        <br>
                        alle: {{ $category->created_at->format('H:i') }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col text-end">
            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-warning">
                Modifica
            </a>
            <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="post" class="d-inline-block"
                onsubmit="return confirm('Sei sicur* di voler eliminare questa categoria?')">
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
                            ID: {{ $category->id }}
                        </li>
                        <li>
                            Slug: {{ $category->slug }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
