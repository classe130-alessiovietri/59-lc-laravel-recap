@extends('layouts.email')

@section('email-title', 'Nuovo messaggio dal sito')

@section('content')
<h1>
    Nuovo messaggio dal sito
</h1>

<ul>
    <li>
        {{-- Nome: <strong>{{ $name }}</strong> --}}
        Nome: <strong>{{ $contact->name }}</strong>
    </li>
    <li>
        {{-- Email: <strong>{{ $email }}</strong> --}}
        Email: <strong>{{ $contact->email }}</strong>
    </li>
    <li>
        Messaggio:

        <p>
            {{-- {!! nl2br($userMessage) !!} --}}
            {!! nl2br($contact->message) !!}
        </p>
    </li>
</ul>
@endsection
