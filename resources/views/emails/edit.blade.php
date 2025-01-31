@extends('layouts.main')

@section('title', 'Editar | Emails')

@section('content')

    <h1>Editar</h1>

    @if ($errors->any())
        <ul>
            @foreach ( $errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('emails.update', $email->id) }}" method="POST">
        @method('PUT')

        <div>
            <label for="from">From:</label>
            <input type="email" name="from" id="from" value="{{ $email->from ?? old('from') }}" >
        </div>

        <div>
            <label for="to">To:</label>
            <input type="email" name="to" id="to" value="{{ $email->to }}">
        </div>

        <div>
            <label for="subject">Asunto:</label>
            <input type="text" name="subject" id="subject" value="{{ $email->subject }}">
        </div>

        <div>
            <label for="body">Cuerpo:</label>
            <textarea name="body" id="body">{{ $email->body }}</textarea>
        </div>

        <button type="submit">Editar</button>
    </form>

@endsection