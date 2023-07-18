<x-guest-layout>
    <form method="POST" action="{{ route('apoderados.register') }}">
        @csrf
        
        <div class="flex flex-row gap-1">
            <div class="basis-1/4">
                <x-input-label for="dni" :value="__('DNI')" />
                <x-text-input id="dni" class="w-full mt-1" type="text" name="dni" required autofocus />
                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
            </div>
            
           
            <!-- Name -->
            <div class="basis-3/4">
                <x-input-label for="name" :value="__('Nombre completo')" />
                <x-text-input id="name" class="mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>
        

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- fecha de nacimiento y teléfono  --}}
        <div class="flex flex-row gap-1 mt-4">
            <div class="basis-1/2">
                <x-input-label for="fecha_nacimiento" :value="__('Fecha de nacimiento')" />
                <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" required autofocus />
                <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
            </div>
            
           
            <!-- phone -->
            <div class="basis-1/2">
                <x-input-label for="numero_celular" :value="__('Número de celular')" />
                <x-text-input id="numero_celular" class="block mt-1 w-full" type="text" name="numero_celular" required autofocus />
                <x-input-error :messages="$errors->get('numero_celular')" class="mt-2" />
            </div>
        </div>
        <div class="flex flex-row gap-1 mt-4">
            <div class="basis-1/2">
                <x-input-label for="ocupacion" :value="__('Ocupación')" />
                <x-text-input id="ocupacion" class="block mt-1 w-full" type="text" name="ocupacion" required autofocus />
                <x-input-error :messages="$errors->get('ocupacion')" class="mt-2" />
            </div>
            
           
            <!-- phone -->
            <div class="basis-1/2">
                <x-input-label for="centro_trabajo" :value="__('Centro de trabajo')" />
                <x-text-input id="centro_trabajo" class="block mt-1 w-full" type="text" name="centro_trabajo" required autofocus />
                <x-input-error :messages="$errors->get('centro_trabajo')" class="mt-2" />
            </div>
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('¿Tiene una cuenta?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
