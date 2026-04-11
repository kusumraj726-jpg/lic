<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Nexorise ERP') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Outfit', sans-serif;
            }
            .glass-panel {
                background: rgba(15, 23, 42, 0.8);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    <body class="antialiased text-slate-200">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#020617] relative overflow-hidden">
            <!-- Simple Dark Theme Background without heavy blue gradients -->

            <div class="mb-6 text-center z-10 w-full flex justify-center">
                <a href="/" class="flex justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="h-20 w-auto object-contain">
                </a>
            </div>

            <div class="w-full sm:max-w-md z-10 px-4">
                <div class="bg-[#0f172a] px-8 py-8 shadow-2xl rounded-[1.5rem] relative border border-slate-800">
                    {{ $slot }}
                </div>
                
                <div class="mt-6 text-center">
                    <p class="text-slate-500 text-xs font-medium uppercase tracking-widest">
                        Official Enterprise Resource Planning Portal
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
