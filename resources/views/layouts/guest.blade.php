<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Cristino Castro - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md p-8 bg-white shadow-xl rounded-2xl">
            <div class="flex justify-center mb-6">
                <a href="/">
                    <img src="{{ url('logo/logo-header.png') }}" alt="">
                </a>
            </div>

            {{ $slot }}
        </div>
    </div>

</body>
</html>
