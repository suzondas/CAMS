<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Dashboard</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
<body>
@include('inlcude.navbar')
<!-- Page Content -->
    <main>
        {{ $slot }}
    </main>


@stack('modals')

@livewireScripts
<!-- Scripts -->
</body>
</html>
