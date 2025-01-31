@extends('layouts.main')

@section('title', 'Detalle | Emails')

@section('content')

    <h1>Detalle</h1>

    <section>
        <article>
            <h3>From: {{ $email->from }} - To: {{ $email->to }} - {{ $email->created_at }}</h3>
            <h4>{{ $email->subject }}</h4>
            <p>{{ $email->body }}</p>

            <form action="{{ route('emails.destroy', $email->id) }}" method="POST">
                @method('DELETE')
                <button type="submit">Borrar email</button>
            </form>
        </article>
    </section>

@endsection