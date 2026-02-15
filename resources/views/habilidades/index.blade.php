<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- MENSAJES DE ÉXITO --}}
            @if(session('success'))
            <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            {{-- LISTADO DE HABILIDADES --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex items-center mb-6 border-b-4 border-indigo-500 pb-2">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Habilidades</h3>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    {{-- Usamos IF para comprobar si hay datos --}}
                    @if($user->habilidades->count() > 0)

                    {{-- Usamos FOREACH para recorrerlos --}}
                    @foreach($user->habilidades as $habilidad)
                    <div class="p-5 bg-gray-50 dark:bg-gray-700 rounded-xl border-l-8 border-indigo-500 flex justify-between items-center shadow-sm">
                        <div class="space-y-1">
                            <h4 class="font-black text-indigo-600 dark:text-indigo-400 text-lg uppercase tracking-tight">
                                {{ $habilidad->nombre_habilidad }}
                            </h4>
                            <p class="text-gray-800 dark:text-gray-100 font-bold flex items-center">
                                🏢 Nivel: {{ $habilidad->nivel }}
                            </p>

                        </div>

                        <div class="flex items-center space-x-4 ml-4">
                            {{-- Botón Editar --}}
                            <a href="{{ route('habilidades.index', ['edit' => $habilidad->id]) }}"
                                class="text-indigo-500 hover:text-indigo-700 text-2xl font-bold transition-transform hover:scale-125"
                                title="Editar">
                                ✎
                            </a>

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('habilidades.destroy', $habilidad) }}" method="POST" onsubmit="return confirm('¿Eliminar esta habilidad?')">
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
                        <p class="text-gray-500 dark:text-gray-400 italic">💼 Aún no has añadido habilidades.</p>
                        <p class="text-sm text-indigo-500 font-bold mt-1">¡Cuéntanos tus habilidades abajo! 👇</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- 2. FORMULARIO DINÁMICO --}}
            <div id="formulario" class="p-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg border-t-8 border-indigo-600">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $habilidadEdit ? '📝 Modificar Habilidad' : '✨ Añadir Nueva Habilidad' }}
                    </h3>
                    <p class="text-sm text-gray-500">Describe tus habilidades y nivel de dominio.</p>
                </div>

                <form method="POST"
                    action="{{ $habilidadEdit ? route('habilidades.update', $habilidadEdit) : route('habilidades.store') }}"
                    class="space-y-6">
                    @csrf
                    @if($habilidadEdit)
                    @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Habilidad --}}
                        <div>
                            <x-input-label value="Nombre de la Habilidad" />
                            <x-text-input name="nombre_habilidad" type="text" class="mt-1 block w-full"
                                :value="old('nombre_habilidad', $habilidadEdit->nombre_habilidad ?? '')" required />
                        </div>

                        {{-- Nivel de Habilidad --}}
                        <div>
                            <x-input-label value="Nivel de Dominio" />
                            <select name="nivel"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>

                                {{-- Si hubo un error verifica si existe el old y lo pone, si no, ve si existe habilidadEdit, y si concuerda con lo que hay en la BD, si es asi lo pone --}}
                                {{-- Como seleccionado, si no es ninguno de los dos simplemente vacio --}}
                                <option value="" disabled {{ old('nivel', $habilidadEdit->nivel ?? '') == '' ? 'selected' : '' }}>
                                    Selecciona un nivel...
                                </option>

                                <option value="1" {{ old('nivel', $habilidadEdit->nivel ?? '') == 1 ? 'selected' : '' }}>
                                   Principiante
                                </option>

                                <option value="2" {{ old('nivel', $habilidadEdit->nivel ?? '') == 2 ? 'selected' : '' }}>
                                    Intermedio 
                                </option>

                                <option value="3" {{ old('nivel', $habilidadEdit->nivel ?? '') == 3 ? 'selected' : '' }}>
                                    Avanzado 
                                </option>

                                <option value="4" {{ old('nivel', $habilidadEdit->nivel ?? '') == 4 ? 'selected' : '' }}>
                                    Experto 
                                </option>
                            </select>
                        </div>

                    </div>
                    
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <x-primary-button>
                            {{ $habilidadEdit ? '💾 Guardar Cambios' : '🚀 Añadir Habilidad' }}
                        </x-primary-button>

                        @if($habilidadEdit)
                        <a href="{{ route('habilidades.index') }}" class="text-sm text-gray-500 hover:text-red-500 underline transition-colors">
                            Cancelar edición
                        </a>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>