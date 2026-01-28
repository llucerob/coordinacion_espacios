<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Coordinación de Espacios - Coinco</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-white text-gray-900 min-h-screen flex flex-col font-sans">
        
        <header class="w-full p-6">
            @if (Route::has('login'))
                <nav class="flex justify-end gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold hover:text-blue-600 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-blue-600 transition">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition shadow-sm">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="flex-1 flex flex-col items-center justify-center p-4">
            <div class="flex flex-col items-center scale-110">
            
                <img src="{{ asset('img/logo muni.png') }}" 
                     alt="Logo Municipalidad de Coinco" 
                     class="w-full max-w-sm h-auto drop-shadow-md">
                
            
            </div>
        </main>

    </body>
</html>
