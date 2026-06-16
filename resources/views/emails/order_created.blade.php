@extends('layouts.main')

@section('content')

    <div class="container-center">
        <h1>Gracias por comprar en BoardMaster</h1>
    </div>

    <section>
        <h2>Esta es la información sobre tu pedido</h2>

        <article>
            <h3>Datos del usuario</h3>

            <div class="container-data">
                <p><strong>Nombre: </strong>{{ $order->delivery_name }} {{ $order->delivery_surname }}</p>
                <p><strong>Email: </strong>{{ $order->email }}</p>
                <p><strong>Dirección: </strong>c/ {{ $order->delivery_address }} - {{ $order->delivery_province }}
                    ({{ $order->delivery_country }}) {{ $order->delivery_zipcode }}</p>
                <p><strong>Teléfono: </strong>{{ $order->delivery_phone }}</p>
            </div>
        </article>

        <article>
            <h3>Pedido</h3>

            <div class="container-data">
                <p><strong>Método de pago: </strong>{{ $order->payment_method }}</p>
                <p><strong>Precio: </strong>{{ $order->total_price }} €</p>
                <p><strong>Productos: </strong></p>

                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Unidades</th>
                            <th>Precio por unidad</th>
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