<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- CABECERA DE LA SECCIÓN --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 border-b-4 border-indigo-500">
                <h2 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tighter">
                    Explorar Talentos
                </h2>
                <p class="text-gray-500 dark:text-gray-400 font-bold uppercase text-xs tracking-widest mt-1">
                    Perfiles profesionales registrados
                </p>
            </div>

            {{--  USUARIOS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($users as $user)
                    @if($user->perfil) {{-- Solo mostramos si tiene perfil --}}
                        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden border-l-8 border-indigo-500 flex flex-col justify-between">
                            <div class="p-6">
                                {{-- Info Básica --}}
                                <div class="mb-4">
                                    <h3 class="text-xl font-black text-gray-900 dark:text-white uppercase leading-tight">
                                        {{ $user->perfil->nombre_completo }}
                                    </h3>
                                    <p class="text-indigo-600 dark:text-indigo-400 font-bold text-xs uppercase tracking-tighter">
                                        {{ $user->perfil->profesion }}
                                    </p>
                                </div>

                                {{--  Bio --}}
                                <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 italic mb-4">
                                    "{{ $user->perfil->sobre_mi }}"
                                </p>
                            </div>

                            {{-- VER MÁS --}}
                            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-700">
                                <a href="{{ route('perfil.show', $user->id) }}" 
                                   class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black uppercase py-2 rounded shadow-md shadow-indigo-500/20 transition-all">
                                    Ver Perfil Completo ↗
                                </a>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-span-full bg-white dark:bg-gray-800 p-12 text-center rounded-lg border-2 border-dashed border-gray-300">
                        <p class="text-gray-500 font-bold uppercase">No hay perfiles registrados todavía.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>