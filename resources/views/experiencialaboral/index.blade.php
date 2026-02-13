<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- MENSAJES DE ÉXITO --}}
            @if(session('success'))
                <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- LISTADO DE EXPERIENCIAS --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex items-center mb-6 border-b-4 border-indigo-500 pb-2">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Trayectoria Profesional</h3>
                </div>
                
                <div class="grid grid-cols-1 gap-4">
                    {{-- Usamos IF para comprobar si hay datos --}}
                    @if($user->experiencias->count() > 0)
                        
                        {{-- Usamos FOREACH para recorrerlos --}}
                        @foreach($user->experiencias as $exp)
                            <div class="p-5 bg-gray-50 dark:bg-gray-700 rounded-xl border-l-8 border-indigo-500 flex justify-between items-center shadow-sm">
                                <div class="space-y-1">
                                    <h4 class="font-black text-indigo-600 dark:text-indigo-400 text-lg uppercase tracking-tight">
                                        {{ $exp->puesto }}
                                    </h4>
                                    <p class="text-gray-800 dark:text-gray-100 font-bold flex items-center">
                                        🏢 {{ $exp->empresa }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                        🗓️ {{ $exp->fecha_inicio->format('M Y') }} — 
                                        {{ $exp->fecha_fin ? $exp->fecha_fin->format('M Y') : 'Actualidad' }}
                                    </p>
                                    @if($exp->descripcion)
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 italic">
                                            "{{ $exp->descripcion }}"
                                        </p>
                                    @endif
                                </div>

                                <div class="flex items-center space-x-4 ml-4">
                                    {{-- Botón Editar --}}
                                    <a href="{{ route('experiencialaboral.index', ['edit' => $exp->id]) }}" 
                                       class="text-indigo-500 hover:text-indigo-700 text-2xl font-bold transition-transform hover:scale-125" 
                                       title="Editar">
                                       ✎
                                    </a>

                                    {{-- Botón Eliminar --}}
                                    <form action="{{ route('experiencialaboral.destroy', $exp) }}" method="POST" onsubmit="return confirm('¿Eliminar esta experiencia?')">
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
                            <p class="text-gray-500 dark:text-gray-400 italic">💼 Aún no has añadido experiencias laborales.</p>
                            <p class="text-sm text-indigo-500 font-bold mt-1">¡Cuéntanos dónde has trabajado abajo! 👇</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- 2. FORMULARIO DINÁMICO --}}
            <div id="formulario" class="p-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg border-t-8 border-indigo-600">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $experienciaEdit ? '📝 Modificar Experiencia' : '✨ Añadir Nueva Experiencia' }}
                    </h3>
                    <p class="text-sm text-gray-500">Describe tus responsabilidades y logros en este puesto.</p>
                </div>

                <form method="POST" 
                    action="{{ $experienciaEdit ? route('experiencialaboral.update', $experienciaEdit) : route('experiencialaboral.store') }}" 
                    class="space-y-6">
                    @csrf
                    @if($experienciaEdit)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Empresa --}}
                        <div>
                            <x-input-label value="Nombre de la Empresa" />
                            <x-text-input name="empresa" type="text" class="mt-1 block w-full"
                                :value="old('empresa', $experienciaEdit->empresa ?? '')" required />
                        </div>

                        {{-- Puesto --}}
                        <div>
                            <x-input-label value="Puesto / Cargo" />
                            <x-text-input name="puesto" type="text" class="mt-1 block w-full"
                                :value="old('puesto', $experienciaEdit->puesto ?? '')" required />
                        </div>

                        {{-- Fechas --}}
                        <div class="grid grid-cols-2 gap-4 md:col-span-2">
                            <div>
                                <x-input-label value="Fecha de Inicio" />
                                <x-text-input name="fecha_inicio" type="date" class="mt-1 block w-full"
                                    :value="old('fecha_inicio', $experienciaEdit ? $experienciaEdit->fecha_inicio->format('Y-m-d') : '')" required />
                            </div>
                            <div>
                                <x-input-label value="Fecha de Fin (Vació para 'Actualidad')" />
                                <x-text-input name="fecha_fin" type="date" class="mt-1 block w-full"
                                    :value="old('fecha_fin', ($experienciaEdit && $experienciaEdit->fecha_fin) ? $experienciaEdit->fecha_fin->format('Y-m-d') : '')" />
                            </div>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div>
                        <x-input-label value="Descripción de Actividades" />
                        <textarea name="descripcion" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" rows="3">{{ old('descripcion', $experienciaEdit->descripcion ?? '') }}</textarea>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <x-primary-button>
                            {{ $experienciaEdit ? '💾 Guardar Cambios' : '🚀 Añadir Experiencia' }}
                        </x-primary-button>

                        @if($experienciaEdit)
                            <a href="{{ route('experiencialaboral.index') }}" class="text-sm text-gray-500 hover:text-red-500 underline transition-colors">
                                Cancelar edición
                            </a>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>