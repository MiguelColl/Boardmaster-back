@extends('layouts.main')

@section('title', 'Editar | Emails')

@section('content')

    <h1>Editar</h1>

    <form action="{{ route('emails.update', $email->id) }}" method="POST">
        @method('PUT')

        <div>
            <label for="from">From:</label>
            <input type="email" name="from" id="from" value="{{ $email->from }}" required>
        </div>

        <div>
            <label for="to">To:</label>
            <input type="email" name="to" id="to" value="{{ $email->to }}" required>
        </div>

        <div>
            <label for="subject">Asunto:</label>
            <input type="text" name="subject" id="subject" value="{{ $email->subject }}" required>
        </div>

        <div>
            <label for="body">Cuerpo:</label>
            <textarea name="body" id="body" required>{{ $email->body }}</textarea>
        </div>

        <button type="submit">Editar</button>
    </form>

@endsection