@extends('layouts.main')

@section('title', 'Nuevo | Emails')

@section('content')

    <h1>Nuevo</h1>

    @if ($errors->any())
        <ul>
            @foreach ( $errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('emails.store') }}" method="POST">
        <div>
            <label for="from">From:</label>
            <input type="email" name="from" id="from" value="{{ old('from') }}">
        </div>

        <div>
            <label for="to">To:</label>
            <input type="email" name="to" id="to" value="{{ old('to') }}">
        </div>

        <div>
            <label for="subject">Asunto:</label>
            <input type="text" name="subject" id="subject" value="{{ old('subject') }}">
        </div>

        <div>
            <label for="body">Cuerpo:</label>
            <textarea name="body" id="body">{{ old('body') }}</textarea>
        </div>

        <button type="submit">Enviar</button>
        <button type="reset">Borrar datos</button>
    </form>

@endsection