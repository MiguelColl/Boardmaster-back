@extends('layouts.main')

@section('title', 'Nuevo | Emails')

@section('content')

    <h1>Nuevo</h1>

    <form action="{{ route('emails.store') }}" method="POST">
        <div>
            <label for="from">From:</label>
            <input type="email" name="from" id="from" required>
        </div>

        <div>
            <label for="to">To:</label>
            <input type="email" name="to" id="to" required>
        </div>

        <div>
            <label for="subject">Asunto:</label>
            <input type="text" name="subject" id="subject" required>
        </div>

        <div>
            <label for="body">Cuerpo:</label>
            <textarea name="body" id="body" required></textarea>
        </div>

        <button type="submit">Enviar</button>
        <button type="reset">Borrar datos</button>
    </form>

@endsection