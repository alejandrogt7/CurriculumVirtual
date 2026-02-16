<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- MENSAJES DE ÉXITO --}}
            @if(session('success'))
            <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            {{-- LISTADO DE FORMACIÓN --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex items-center mb-6 border-b-4 border-indigo-500 pb-2">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Mis Títulos y Estudios</h3>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    {{-- Usamos @forelse para manejar el listado y el estado vacío a la vez --}}
                    @forelse($user->educaciones as $edu)
                    <div class="p-5 bg-gray-50 dark:bg-gray-700 rounded-xl border-l-8 border-indigo-500 flex justify-between items-center shadow-sm">
                        <div class="space-y-1">
                            <h4 class="font-black text-indigo-600 dark:text-indigo-400 text-lg uppercase tracking-tight">
                                {{ $edu->titulo_obtenido }}
                            </h4>
                            <p class="text-gray-800 dark:text-gray-100 font-bold flex items-center">
                                🏫 {{ $edu->institucion }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                🗓️ {{ $edu->fecha_inicio->format('M Y') }} —
                                {{ $edu->fecha_fin ? $edu->fecha_fin->format('M Y') : 'Actualidad' }}
                            </p>
                        </div>

                        <div class="flex items-center space-x-4 ml-4">
                            {{-- Botón Editar --}}
                            <a href="{{ route('educacion.index', ['edit_edu' => $edu->id]) }}"
                                class="text-indigo-500 hover:text-indigo-700 text-2xl font-bold transition-transform hover:scale-125"
                                title="Editar">
                                ✎
                            </a>

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('educacion.destroy', $edu) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-2xl font-bold transition-transform hover:scale-125">
                                    ✖
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    {{-- Esto solo se muestra si $user->educaciones esta vacio --}}
                    <div class="text-center py-10 bg-gray-50 dark:bg-gray-700/50 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600">
                        <p class="text-gray-500 dark:text-gray-400 italic">🎓 No has añadido ninguna formación académica aún.</p>
                        <p class="text-sm text-indigo-500 font-bold mt-1">¡Utiliza el formulario de abajo para empezar!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- 2. FORMULARIO DINÁMICO --}}
            <div id="form-educacion" class="p-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg border-t-8 border-indigo-600">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $eduEdit ? '📝 Modificar Formación' : '✨ Añadir Nueva Formación' }}
                    </h3>
                    <p class="text-sm text-gray-500">Registra tus títulos, cursos o certificaciones.</p>
                </div>

                <form method="POST" action="{{ $eduEdit ? route('educacion.update', $eduEdit) : route('educacion.store') }}" class="space-y-6">
                    @csrf
                    @if($eduEdit)
                    @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label value="Título Obtenido / Certificación" />
                            <x-text-input name="titulo_obtenido" type="text" class="mt-1 block w-full"
                                :value="old('titulo_obtenido', $eduEdit->titulo_obtenido ?? '')" required />
                        </div>

                        <div>
                            <x-input-label value="Institución Educativa" />
                            <x-text-input name="institucion" type="text" class="mt-1 block w-full"
                                :value="old('institucion', $eduEdit->institucion ?? '')" required />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label value="Fecha de Inicio" />
                                <x-text-input name="fecha_inicio" type="date" class="mt-1 block w-full"
                                    :value="old('fecha_inicio', $eduEdit ? $eduEdit->fecha_inicio->format('Y-m-d') : '')" required />
                            </div>
                            <div>
                                <x-input-label value="Fecha de Fin" />
                                <x-text-input name="fecha_fin" type="date" class="mt-1 block w-full"
                                    :value="old('fecha_fin', ($eduEdit && $eduEdit->fecha_fin) ? $eduEdit->fecha_fin->format('Y-m-d') : '')" />
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <x-primary-button>
                            {{ $eduEdit ? '💾 Actualizar Formación' : '🚀 Añadir a mi Perfil' }}
                        </x-primary-button>

                        @if($eduEdit)
                        <a href="{{ route('educacion.index') }}" class="text-sm text-gray-500 hover:text-red-500 underline transition-colors">
                            Cancelar edición
                        </a>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>