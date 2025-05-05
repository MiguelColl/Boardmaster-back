@extends('layouts.main')

@section('content')

    <div class="container-center">
        <h1>Thanks for being part of our community!</h1>
    </div>

    <section>
        <p>Dear {{ $user->name }},</p>
        <p>The {{ config('app.name') }} community will miss you, but we're glad you were a part of it.</p>        
        <p>We hope you come back soon, we'll have a place for you at our tables.</p>
        <br/>
        <p>Best regards,</p>
        <p>The {{ config('app.name') }} Team.</p>
    </section>

@endsection