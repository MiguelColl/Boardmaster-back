<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Email')</title>
    <style>
        .container-center {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }

        .content {
            grid-column: 2;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 3fr 1fr;

        }

        .container-data {
            margin: 0px 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            width: 25%;
        }

        thead {
            background-color: #b2d7ff;
            color: rgb(0, 0, 0);
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:nth-child(even) {
            background-color: #e9ecef;
        }

        @media (max-width: 576px) {
            .container {
                grid-template-columns: 1fr;
            }

            .content {
                grid-column: 1;
                margin: 0 8px;
            }

            .container-data {
                margin: 0px 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <main class="content">
            @yield('content')
        </main>
    </div>

    <footer class="container-center">
        <img src="{{ asset('images/logo_BM.png') }}" alt="Logo" width="250">
    </footer>
</body>

</html>