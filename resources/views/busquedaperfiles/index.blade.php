<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                
                {{-- Cabecera de la búsqueda --}}
                <div class="flex justify-between items-center mb-6 border-b-4 border-indigo-500 pb-2">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Perfil Encontrado</h3>
                </div>

                @if($user && $user->perfil)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Columna Izquierda: Info Principal --}}
                        <div class="space-y-4">
                            <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-xl border-l-8 border-indigo-500">
                                <h2 class="text-2xl font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-tighter">
                                    {{ $user->perfil->nombre_completo }}
                                </h2>
                                <p class="text-lg font-medium text-gray-700 dark:text-gray-200">
                                    💼 {{ $user->perfil->profesion }}
                                </p>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 italic">
                                "{{ $user->perfil->sobre_mi }}"
                            </p>
                        </div>

                        {{-- Columna Derecha: Contacto --}}
                        <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-xl space-y-3 shadow-sm">
                            <h3 class="text-sm font-bold text-gray-400 uppercase border-b border-gray-600 pb-1 mb-2">Contacto</h3>
                            <p class="text-gray-700 dark:text-gray-200">📧 <span class="ml-2">{{ $user->perfil->correo_electronico }}</span></p>
                            <p class="text-gray-700 dark:text-gray-200">📞 <span class="ml-2">{{ $user->perfil->telefono ?? 'No disponible' }}</span></p>
                            
                            <div class="pt-2 flex flex-col space-y-2">
                                @if($user->perfil->linkedin)
                                    <a href="{{ $user->perfil->linkedin }}" target="_blank" class="text-indigo-400 hover:underline">🔗 LinkedIn</a>
                                @endif
                                @if($user->perfil->github)
                                    <a href="{{ $user->perfil->github }}" target="_blank" class="text-indigo-400 hover:underline">🔗 GitHub</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr class="my-8 border-gray-200 dark:border-gray-700">

                    {{-- Aquí podrías añadir los bucles de Educación y Experiencia --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-4 uppercase text-sm tracking-widest">🎓 Formación</h4>
                            @forelse($user->educaciones as $edu)
                                <div class="mb-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border-l-4 border-indigo-400">
                                    <p class="font-bold dark:text-white">{{ $edu->titulo }}</p>
                                    <p class="text-xs text-gray-500">{{ $edu->institucion }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm italic">No hay estudios registrados.</p>
                            @endforelse
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-4 uppercase text-sm tracking-widest">💪 Habilidades</h4>
                            <div class="flex flex-wrap gap-2">
                                @forelse($user->habilidades as $hab)
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300 rounded-full text-xs font-bold">
                                        {{ $hab->nombre_habilidad }} (Nivel {{ $hab->nivel }})
                                    </span>
                                @empty
                                    <p class="text-gray-500 text-sm italic">No hay habilidades registradas.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                @else
                    {{-- Mensaje de error si no hay perfil --}}
                    <div class="text-center py-10 bg-gray-50 dark:bg-gray-700/50 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600">
                        <p class="text-gray-500 dark:text-gray-400 text-lg italic">⚠️ Este usuario aún no ha completado su perfil público.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>