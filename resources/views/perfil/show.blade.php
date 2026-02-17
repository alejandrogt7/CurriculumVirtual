<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if($user && $user->perfil)
            {{-- HEADER --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 border-b-4 border-indigo-500">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h2 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tighter">
                            {{ $user->perfil->nombre_completo }}
                        </h2>
                        <p class="text-indigo-600 dark:text-indigo-400 font-bold uppercase text-sm tracking-widest">
                            {{ $user->perfil->profesion }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- SECCIÓN 2: BIOGRAFÍA (Con el borde lateral que usamos en el Perfil) --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 border-l-8 border-indigo-500">
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Sobre mí</h3>
                <p class="text-gray-700 dark:text-gray-300 italic text-lg">
                    "{{ $user->perfil->sobre_mi }}"
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- EXPERIENCIA --}}
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b-2 border-indigo-500 pb-1 inline-block">
                        Experiencia Laboral
                    </h3>
                    <div class="space-y-6 mt-4">
                        @forelse($user->experiencias as $exp)
                        <div class="relative pl-4 border-l-2 border-gray-200 dark:border-gray-700">
                            <h4 class="font-black text-gray-800 dark:text-white uppercase text-sm">{{ $exp->puesto }}</h4>
                            <p class="text-indigo-600 dark:text-indigo-400 font-bold text-xs">{{ $exp->empresa }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase">
                                {{ $exp->fecha_inicio->format('M Y') }} - {{ $exp->fecha_fin ? $exp->fecha_fin->format('M Y') : 'Actualidad' }}
                            </p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">{{ $exp->descripcion }}</p>
                        </div>
                        @empty
                        <p class="text-gray-500 text-sm italic">Sin experiencia registrada.</p>
                        @endforelse
                    </div>
                </div>

                {{-- EDUCACIÓN Y SKILLS --}}
                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b-2 border-indigo-500 pb-1 inline-block">
                            Formación
                        </h3>
                        <div class="space-y-4 mt-2">
                            @forelse($user->educaciones as $edu)
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm">{{ $edu->titulo }}</h4>
                                <p class="text-xs text-gray-500">{{ $edu->institucion }}</p>
                            </div>
                            @empty
                            <p class="text-gray-500 text-sm italic">Sin formación registrada.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b-2 border-indigo-500 pb-1 inline-block">
                            Habilidades Técnicas
                        </h3>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @forelse($user->habilidades as $hab)
                            <span class="px-3 py-1 bg-indigo-600 text-white text-xs font-black rounded-md uppercase tracking-tighter">
                                {{ $hab->nombre_habilidad }}
                            </span>
                            @empty
                            <p class="text-gray-500 text-sm italic">Sin habilidades.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- PROYECTOS (Estilo tarjetas de admin) --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 border-b-2 border-indigo-500 pb-1 inline-block">
                    Proyectos Destacados
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($user->proyectos as $proy)
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border-2 border-gray-100 dark:border-gray-600">
                        <h4 class="font-black text-indigo-600 dark:text-indigo-400 uppercase text-xs mb-1">{{ $proy->nombre_proyecto }}</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-300 line-clamp-2">{{ $proy->descripcion }}</p>
                        @if($proy->url)
                        <a href="{{ $proy->url }}" target="_blank" class="text-[10px] font-black text-gray-400 hover:text-indigo-500 uppercase mt-2 inline-block">Ver Proyecto ↗</a>
                        @endif
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm italic">No hay proyectos para mostrar.</p>
                    @endforelse
                </div>
            </div>

            @else
            {{-- VISTA SI NO HAY RESULTADO --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-12 text-center border-l-8 border-red-500">
                <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase">Perfil No Encontrado</h2>
                <p class="text-gray-500 mt-2">El enlace es incorrecto o el usuario no existe.</p>
                <a href="/" class="mt-6 inline-block px-6 py-2 bg-indigo-600 text-white font-black rounded-md uppercase text-xs">Volver</a>
            </div>
            @endif

            {{-- VOLVER A LA VISTA DE USERS --}}
            <div class="text-center pt-6">
                <a href="{{ route('busquedaperfiles.index') }}" class="inline-flex items-center text-xs font-black text-gray-400 hover:text-indigo-500 uppercase tracking-widest transition-colors">
                    ⬅️ Volver al directorio de talentos
                </a>
            </div>

        </div>
    </div>
</x-app-layout>