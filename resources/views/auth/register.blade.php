<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="dui" :value="__('dui')" />
            <x-text-input id="dui" class="block mt-1 w-full" type="text" name="dui" :value="old('dui')" required autofocus autocomplete="dui" />
            <x-input-error :messages="$errors->get('dui')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

         <!-- Empleado -->
         <div class="mt-4">
            <x-input-label for="empleado" :value="__('empleado')" />
            <x-text-input id="empleado" class="block mt-1 w-full"  name="empleado" :value="old('empleado')" required autocomplete="empleado" />
            <x-input-error :messages="$errors->get('empleado')" class="mt-2" />
        </div>

         <!-- COD_EMPLEADO -->
         <div class="mt-4">
            <x-input-label for="cod_empleado" :value="__('cod_empleado')" />
            <x-text-input id="cod_empleado" class="block mt-1 w-full" name="cod_empleado" :value="old('cod_empleado')" required autocomplete="cod_empleado" />
            <x-input-error :messages="$errors->get('cod_empleado')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
