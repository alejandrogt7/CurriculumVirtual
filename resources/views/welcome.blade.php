<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MiPerfil Pro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-[#111827] text-gray-900 dark:text-[#EDEDEC] font-sans antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center px-6">
        
        <main class="w-full max-w-2xl bg-white dark:bg-[#161615] shadow-xl rounded-3xl border border-gray-100 dark:border-gray-800 p-8 lg:p-12 text-center">
            
            <div class="flex justify-center mb-8">
               <x-application-logo class="block h-16 w-auto fill-current text-gray-800 dark:text-gray-200"  />
            </div>

            <h1 class="text-4xl font-black letter-spacing-tight mb-4 uppercase">
                Curriculum<span class="text-indigo-600">Virtual</span>
            </h1>
            
            <p class="text-lg text-gray-500 dark:text-gray-400 mb-10 italic">
                Gestiona tu Perfil, Educación y Experiencia en un solo lugar. <br class="hidden sm:block"> 
                Limpio, profesional y listo para el éxito.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/perfil') }}" class="w-full sm:w-auto px-8 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/25">
                            Ir a mi Panel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 rounded-xl font-bold hover:bg-gray-200 dark:hover:bg-gray-700 transition-all">
                            Iniciar Sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/25">
                                Crear Cuenta
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </main>

        <footer class="mt-8 text-gray-400 text-xs uppercase tracking-widest">
            &copy; {{ date('Y') }} — Currículum Virtual Profesional por Alejandro García
        </footer>
    </div>

</body>
</html>