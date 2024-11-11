@extends('layouts.app')

@section('page-title', 'Messaggio')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Messaggio
                    </h1>
                    <h6 class="text-center">
                        Creato il: {{ $contact->created_at->format('d/m/Y') }}
                        <br>
                        alle: {{ $contact->created_at->format('H:i') }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col text-end">
            <form action="{{ route('admin.tags.destroy', ['tag' => $contact->id]) }}" method="post" class="d-inline-block"
                onsubmit="return confirm('Sei sicur* di voler eliminare questo tag?')">
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
                            ID: {{ $contact->id }}
                        </li>
                        <li>
                            Nome: {{ $contact->name }}
                        </li>
                        <li>
                            Email: {{ $contact->email }}
                        </li>
                        <li>
                            Messaggio:

                            <blockquote class="border-start border-3 ps-2">
                                {!! nl2br($contact->message) !!}
                            </blockquote>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
