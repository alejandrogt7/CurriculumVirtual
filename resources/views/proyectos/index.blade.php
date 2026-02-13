<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4 border-b-4 border-indigo-500 pb-2">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Mi información personal</h1>
                    
                    @if($user->perfil)
                        <div class="flex space-x-3">
                            <a href="?edit_perfil=1#form-perfil" class="text-indigo-400 text-xl font-bold">✎</a>
                            
                            {{-- Botón Eliminar --}}
                            <form action="{{ route('perfil.destroy', $user->perfil) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-xl font-bold">✖</button>
                            </form>
                        </div>
                    @endif
                </div>

                @if($user->perfil)
                    <div class="grid grid-cols-2 gap-6">
                        {{-- Datos del Perfil --}}
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="font-bold text-indigo-400 mb-2">👤 {{ $user->name }}</h3>
                            <p class="text-white">💼 {{ $user->perfil->profesion }}</p>
                            <p class="text-gray-300 mt-2 text-sm italic">"{{ $user->perfil->sobre_mi }}"</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-white">📞 {{ $user->perfil->telefono ?? 'Sin teléfono' }}</p>
                            <p class="text-white">📧 {{ $user->email }}</p>
                            <div class="mt-2 space-y-1">
                                <a href="{{ $user->perfil->linkedin }}" target="_blank" class="text-indigo-400 text-sm block cursor-pointer">🔗 {{ $user->perfil->linkedin }}</a>
                                <a href="{{ $user->perfil->github }}" target="_blank" class="text-indigo-400 text-sm block cursor-pointer">🔗 {{ $user->perfil->github }}</a>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic text-center">Aún no has completado tu perfil profesional.</p>
                @endif
            </div>

            
            <div id="form-perfil" class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ request('edit_perfil') ? 'Actualizar Mi Perfil' : 'Crear Perfil Profesional' }}
                </h3>

                <form method="POST" 
                      action="{{ $user->perfil && request('edit_perfil') ? route('perfil.update', $user->perfil) : route('perfil.store') }}" 
                      class="space-y-4">
                    @csrf
                    @if($user->perfil && request('edit_perfil'))
                        @method('PATCH')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label :value="__('Profesión')" />
                            <x-text-input name="profesion" type="text" class="mt-1 block w-full" 
                                :value="old('profesion', $user->perfil->profesion ?? '')" required />
                        </div>
                        <div>
                            <x-input-label :value="__('Teléfono')" />
                            <x-text-input name="telefono" type="text" class="mt-1 block w-full" 
                                :value="old('telefono', $user->perfil->telefono ?? '')" />
                        </div>
                        <div>
                            <x-input-label :value="__('LinkedIn (usuario)')" />
                            <x-text-input name="linkedin" type="text" class="mt-1 block w-full" 
                                :value="old('linkedin', $user->perfil->linkedin ?? '')" />
                        </div>
                        <div>
                            <x-input-label :value="__('GitHub (usuario)')" />
                            <x-text-input name="github" type="text" class="mt-1 block w-full" 
                                :value="old('github', $user->perfil->github ?? '')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label :value="__('Sobre mí')" />
                        <textarea name="sobre_mi" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('sobre_mi', $user->perfil->sobre_mi ?? '') }}</textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>
                            {{ $user->perfil && request('edit_perfil') ? 'Guardar Cambios' : 'Crear Perfil' }}
                        </x-primary-button>

                        @if(request('edit_perfil'))
                            <a href="{{ url()->current() }}" class="text-sm text-gray-400 hover:underline">Cancelar</a>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>