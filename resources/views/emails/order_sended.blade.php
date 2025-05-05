@extends('layouts.main')

@section('content')

    <div class="container-center">
        <h1>Your order is on its way!</h1>
    </div>

    <section>
        <p>You'll receive your order within the next 2-3 days. Thanks again for shopping with us!</p>

        <article>            
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Units</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->lines as $line)
                        <tr>
                            <td>{{ $line->name }}</td>
                            <td>{{ $line->units }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </article>
    </section>

@endsection