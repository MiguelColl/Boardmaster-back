@extends('layouts.main')

@section('content')

    <div class="container-center">
        <h1>Thanks for shopping at BoardMaster!</h1>
    </div>

    <section>
        <h2>This is the information about your order</h2>

        <article>
            <h3>User data</h3>
            
            <div class="container-data">
                <p><strong>Name: </strong>{{ $order->delivery_name }} {{ $order->delivery_surname }}</p>
                <p><strong>Email: </strong>{{ $order->email }}</p>
                <p><strong>Address: </strong>c/ {{ $order->delivery_address }} - {{ $order->delivery_province }} ({{ $order->delivery_country }}) {{ $order->delivery_zipcode }}</p>
                <p><strong>Phone: </strong>{{ $order->delivery_phone }}</p>
            </div>
        </article>

        <article>
            <h3>Order</h3>
            
            <div class="container-data">
                <p><strong>Payment method: </strong>{{ $order->payment_method }}</p>
                <p><strong>Price: </strong>{{ $order->total_price }} €</p>
                <p><strong>Products: </strong></p>

                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Units</th>
                            <th>Price per unit</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->lines as $line)
                            <tr>
                                <td>{{ $line->name }}</td>
                                <td>{{ $line->units }}</td>
                                <td>{{ $line->price_unit }} €</td>
                                <td>{{ $line->price_total }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </article>
    </section>

@endsection