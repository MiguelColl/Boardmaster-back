@extends('layouts.main')

@section('title', 'Listado | Emails')

@section('content')

    <h1>Listado</h1>

    <section>
        @forelse ($emails as $email)
            <article>
                <h3>From: {{ $email->from }} - To: {{ $email->to }} - {{ $email->created_at }}</h3>
                <a href="{{ route('emails.show', $email->id) }}">Detalles</a>
                <a href="{{ route('emails.edit', $email->id) }}">Editar</a>
            </article>
        @empty
            <p>No se han encontrado emails</p>
        @endforelse
    </section>

@endsection