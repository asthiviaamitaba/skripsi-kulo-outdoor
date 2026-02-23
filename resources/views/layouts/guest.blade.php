<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kulo Outdoor') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased"
      style="
        background: linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.25)),
        url('{{ asset('images/bg-outdoor.jpg') }}');
        background-size: cover;
        background-position: center;
      ">

    <div class="min-h-screen flex items-center justify-center">

        <div class="w-full sm:max-w-md px-8 py-6 bg-white/95 backdrop-blur-sm
 rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.35)]">

            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo-kulo.png') }}"
                    alt="Logo Kulo Outdoor"
                    class="h-16">
            </div>

            {{ $slot }}

        </div>

    </div>



</body>
</html>
