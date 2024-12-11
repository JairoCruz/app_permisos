<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
        @notifyCss
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    @include('notify::components.notify')
        <div class="min-h-screen bg-gray-200">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @notifyJs
        <script>
            new DataTable('#permisos', {
                ajax: "{{ route('permiso.index')}}",
                columns: [
                    { data: 'fecha_solic' },
                    { data: 'cod_permiso' },
                    { data: 'fecha_inicial' },
                    { data: 'hora_inicial' },
                    { data: 'fecha_final' },
                    { data: 'hora_final' },
                    { data: 'total_tiempo' },
                    { data: 'estado' },
                ],
                language: {
                    search: 'Buscar:',
                    lengthMenu: 'Mostrando _MENU_ por pagina',
                    entries: {
                        _: 'Permisos',
                    },
                    info: 'Mostrando pagina _PAGE_ de _PAGES_',
                    infoEmpty: 'No hay registros para mostrar',
                    infoFiltered: '- filtrado de _MAX_ registros'
                }
            });
        </script>
    </body>
</html>
