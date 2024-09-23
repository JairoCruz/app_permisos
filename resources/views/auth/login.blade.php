<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- COD_EMPLEADO -->
        <div>
            <x-input-label for="dui" :value="__('Dui')" />
            <x-text-input id="dui" class="block mt-1 w-full" name="dui" :value="old('dui')" required autofocus
                autocomplete="dui" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Acceder') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>