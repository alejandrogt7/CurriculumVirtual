<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- MENSAJES DE ÉXITO --}}
            @if(session('success'))
            <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            {{-- LISTADO DE PROYECTOS --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex items-center mb-6 border-b-4 border-indigo-500 pb-2">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Proyectos</h3>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    {{-- Usamos IF para comprobar si hay datos --}}
                    @if($user->proyectos->count() > 0)

                    {{-- Usamos FOREACH para recorrerlos --}}
                    @foreach($user->proyectos as $proyecto)
                    <div class="p-5 bg-gray-50 dark:bg-gray-700 rounded-xl border-l-8 border-indigo-500 flex justify-between items-center shadow-sm">
                        <div class="space-y-1">
                            <h4 class="font-black text-indigo-600 dark:text-indigo-400 text-lg uppercase tracking-tight">
                                {{ $proyecto->titulo }}
                            </h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 italic">
                                "{{ $proyecto->descripcion }}"
                            </p>
                            <div>
                                <a href="{{ $proyecto->enlace_proyecto }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 text-sm flex items-center font-bold underline">
                                    🔗 !Pincha aquí para ver mi proyecto!
                                </a>
                            </div>


                        </div>

                        <div class="flex items-center space-x-4 ml-4">
                            {{-- Botón Editar --}}
                            <a href="{{ route('proyectos.index', ['edit' => $proyecto->id]) }}"
                                class="text-indigo-500 hover:text-indigo-700 text-2xl font-bold transition-transform hover:scale-125"
                                title="Editar">
                                ✎
                            </a>

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST" onsubmit="return confirm('¿Eliminar este proyecto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-2xl font-bold transition-transform hover:scale-125">
                                    ✖
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    @else
                    {{-- Mensaje de "vacío" si no hay registros --}}
                    <div class="text-center py-10 bg-gray-50 dark:bg-gray-700/50 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600">
                        <p class="text-gray-500 dark:text-gray-400 italic">💼 Aún no has añadido proyectos.</p>
                        <p class="text-sm text-indigo-500 font-bold mt-1">¡Cuéntanos tus proyectos abajo! 👇</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- 2. FORMULARIO DINÁMICO --}}
            <div id="formulario" class="p-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg border-t-8 border-indigo-600">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $proyectoEdit ? '📝 Modificar Proyecto' : '✨ Añadir Nuevo Proyecto' }}
                    </h3>
                    <p class="text-sm text-gray-500">Describe tus proyectos y enlaces.</p>
                </div>

                <form method="POST"
                    action="{{ $proyectoEdit ? route('proyectos.update', $proyectoEdit) : route('proyectos.store') }}"
                    class="space-y-6">
                    @csrf
                    @if($proyectoEdit)
                    @method('PUT')
                    @endif

                    <div class="grid grid-cols- md:grid-cols-2 gap-6">
                        {{-- Proyecto --}}
                        <div>
                            <x-input-label value="Nombre del Proyecto" />
                            <x-text-input name="titulo" type="text" class="mt-1 block w-full"
                                :value="old('titulo', $proyectoEdit->titulo ?? '')" required />
                        </div>

                        {{-- Enlace del Proyecto --}}
                        <div>
                            <x-input-label value="Enlace del Proyecto (opcional)" />
                            <x-text-input name="enlace_proyecto" type="url" class="mt-1 block w-full"
                                :value="old('enlace_proyecto', $proyectoEdit->enlace_proyecto ?? '')" />
                        </div>

                    </div>
                    {{-- Descripción --}}
                    <div>
                        <x-input-label value="Descripción del Proyecto" />
                        <textarea name="descripcion" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" rows="3">{{ old('descripcion', $proyectoEdit->descripcion ?? '') }}</textarea>
                    </div>
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <x-primary-button>
                            {{ $proyectoEdit ? '💾 Guardar Cambios' : '🚀 Añadir Proyecto' }}
                        </x-primary-button>

                        @if($proyectoEdit)
                        <a href="{{ route('proyectos.index') }}" class="text-sm text-gray-500 hover:text-red-500 underline transition-colors">
                            Cancelar edición
                        </a>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>