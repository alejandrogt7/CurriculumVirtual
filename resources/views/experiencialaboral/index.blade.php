    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gestionar Experiencia Laboral') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 ">Mis Experiencias</h3>
                    <div class="space-y-4">
                        @if($user->experiencias->count() > 0)
                            @foreach($user->experiencias as $exp)
                                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border-l-4 border-indigo-500">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-bold text-lg text-indigo-600 dark:text-indigo-400">
                                                {{ $exp->puesto }}
                                            </h4>
                                            <h4 class="text-md text-indigo-600 dark:text-indigo-400">
                                                {{ $exp->empresa }}
                                            </h4>
                                        </div>
                                        
                                        {{-- Con los resources puedo pasar al destroy directamente el id en el segundo parametro del route --}}
                                        <form action="{{ route('experiencialaboral.destroy', $exp) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 text-xl font-bold transition leading-none">
                                                <span class="text-sm">Eliminar</span>
                                            </button>
                                        </form>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        {{ $exp->fecha_inicio }} - {{ $exp->fecha_fin ?? 'Actualidad' }}
                                    </p>
                                    <p class="mt-2 text-gray-700 dark:text-gray-300">
                                        {{ $exp->descripcion }}
                                    </p>
                                </div>
                            @endforeach
                        @else
                        <p class="text-gray-500 italic">Aún no has añadido experiencias laborales.</p
                            @endif

                            </div>
                    </div>

                    <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Añadir Experiencia</h3>

                        <form method="POST" action="{{ route('experiencialaboral.store') }}" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="empresa" :value="__('Empresa')" />
                                    <x-text-input id="empresa" name="empresa" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="puesto" :value="__('Puesto')" />
                                    <x-text-input id="puesto" name="puesto" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="fecha_inicio" :value="__('Fecha de Inicio')" />
                                    <x-text-input id="fecha_inicio" name="fecha_inicio" type="date" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="fecha_fin" :value="__('Fecha de Fin (Vacío si es actual)')" />
                                    <x-text-input id="fecha_fin" name="fecha_fin" type="date" class="mt-1 block w-full" />
                                </div>
                            </div>
                            <div>
                                <x-input-label for="descripcion" :value="__('Descripción de actividades')" />
                                <textarea id="descripcion" name="descripcion" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3"></textarea>
                            </div>

                            {{--Si lo meto en __('') lo que hace es buscar en lang si hay traducción --}}
                            <x-primary-button>{{ __('Agregar Experiencia') }}</x-primary-button>
                        </form>
                    </div>



                </div>
            </div>
    </x-app-layout>