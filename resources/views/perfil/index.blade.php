<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- MENSAJES DE ÉXITO --}}
            @if(session('success'))
            <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6 border-b-4 border-indigo-500 pb-2">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Mi Perfil Profesional</h3>

                    @if($user->perfil)
                    <div class="flex space-x-4">
                        <a href="?edit_perfil=1" class="text-indigo-400 text-xl font-bold hover:scale-110 transition-transform">✎</a>
                        <form action="{{ route('perfil.destroy', $user->perfil) }}" method="POST" onsubmit="return confirm('¿Eliminar perfil por completo?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 text-xl font-bold hover:scale-110 transition-transform">✖</button>
                        </form>
                    </div>
                    @endif
                </div>

                {{-- VISTA PREVIA DEL PERFIL --}}
                @if($user->perfil)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 {{ request('edit_perfil') ? 'opacity-50' : '' }}">
                    <div class="space-y-4">
                        <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-xl border-l-8 border-indigo-500">
                            <h2 class="text-2xl font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-tighter">
                                {{ $user->perfil->nombre_completo }}
                            </h2>
                            <p class="text-lg font-medium text-gray-700 dark:text-gray-200">💼 {{ $user->perfil->profesion }}</p>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 italic">"{{ $user->perfil->sobre_mi }}"</p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-xl space-y-3 shadow-sm">
                        <h3 class="text-sm font-bold text-gray-400 uppercase border-b border-gray-600 pb-1 mb-2">Contacto y Redes</h3>
                        <p class="text-gray-700 dark:text-gray-200">📧 <span class="ml-2">{{ $user->perfil->correo_electronico }}</span></p>
                        <p class="text-gray-700 dark:text-gray-200">📞 <span class="ml-2">{{ $user->perfil->telefono ?? 'N/A' }}</span></p>

                        <div class="pt-2 flex flex-col space-y-2">
                            @if($user->perfil->linkedin)
                            <a href="{{ $user->perfil->linkedin }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 text-sm flex items-center font-bold underline">🔗 LinkedIn</a>
                            @endif
                            @if($user->perfil->github)
                            <a href="{{ $user->perfil->github }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 text-sm flex items-center font-bold underline">🔗 GitHub</a>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                {{-- Mensaje de vacío DENTRO del mismo contenedor --}}
                <div class="text-center py-10 bg-gray-50 dark:bg-gray-700/50 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600">
                    <p class="text-gray-500 dark:text-gray-400 text-lg italic">👤 Aún no has configurado tu perfil profesional público.</p>
                    <p class="text-sm text-indigo-500 font-bold mt-1">¡Completa el formulario de abajo para empezar! 👇</p>
                </div>
                @endif
            </div>

            {{-- FORMULARIO DINÁMICO --}}
            @if(!$user->perfil || request('edit_perfil'))
            <div id="form-perfil" class="p-8 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg border-t-8 border-indigo-600">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                        {{ request('edit_perfil') ? '📝 Modificar mis datos' : '✨ Nuevo Perfil Profesional' }}
                    </h3>
                    <p class="text-sm text-gray-500">Completa tu perfil.Conecta con todos!.</p>
                </div>

                <form method="POST" action="{{ $user->perfil && request('edit_perfil') ? route('perfil.update', $user->perfil) : route('perfil.store') }}" class="space-y-6">
                    @csrf
                    @if($user->perfil && request('edit_perfil')) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label value="Nombre Completo" />
                            <x-text-input name="nombre_completo" type="text" class="mt-1 block w-full" :value="old('nombre_completo', $user->perfil->nombre_completo ?? '')" required />
                        </div>
                        <div>
                            <x-input-label value="Email de Contacto" />
                            <x-text-input name="correo_electronico" type="email" class="mt-1 block w-full" :value="old('correo_electronico', $user->perfil->correo_electronico ?? '')" required />
                        </div>
                        <div>
                            <x-input-label value="Profesión" />
                            <x-text-input name="profesion" type="text" class="mt-1 block w-full" :value="old('profesion', $user->perfil->profesion ?? '')" required />
                        </div>
                        <div>
                            <x-input-label value="Teléfono Móvil" />
                            <x-text-input name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono', $user->perfil->telefono ?? '')" />
                        </div>
                        <div>
                            <x-input-label value="URL de LinkedIn" />
                            <x-text-input name="linkedin" type="url" class="mt-1 block w-full border-blue-400" :value="old('linkedin', $user->perfil->linkedin ?? '')" />
                        </div>
                        <div>
                            <x-input-label value="URL de GitHub" />
                            <x-text-input name="github" type="url" class="mt-1 block w-full border-gray-400" :value="old('github', $user->perfil->github ?? '')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Sobre mí (Bio)" />
                        <textarea name="sobre_mi" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('sobre_mi', $user->perfil->sobre_mi ?? '') }}</textarea>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-700">
                        <x-primary-button>
                            {{ $user->perfil && request('edit_perfil') ? '💾 Guardar Cambios' : '🚀 Publicar Perfil' }}
                        </x-primary-button>
                        @if(request('edit_perfil') )
                        <a href="{{ route('perfil.index') }}" class="text-sm text-gray-500 hover:text-red-500 underline transition-colors">Cancelar</a>
                        @endif
                    </div>
                </form>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>