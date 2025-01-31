<html lang="es">
    <head>
        <title>@yield('title')</title>
    </head>

    <body>
        <header>
            @include('layouts.menu')
        </header>

        <main class="container">
            @yield('content')
        </main>
    </body>
</html>