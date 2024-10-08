<x-app-layout>


    <div class="py-9">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4">

                <div class="w-full max-w-md mx-auto bg-white shadow-md overflow-hidden sm:rounded-lg px-4 py-4">
                    <p class="leading-normal text-left text-pretty text-gray-400 text-sm">
                        Ingresa el numero de DUI de tu compañero para poder registrar un permiso con sus datos,
                        recuerda que al finalizar el registro quedara en el historial de tu compañero.

                    </p>
                    <form action="{{ route('permiso.create') }}" method="get">
                    <div class="my-2">
                        <x-input-label for="dui" :value="__('Dui')" />
                        <x-text-input id="dui" class="block mt-1 w-full" name="dui" :value="old('dui')" required
                            autofocus autocomplete="dui" placeholder="Ingresa el número de dui de tu compañero" />
                            <div class="flex items-center justify-end mt-3">
                                <x-primary-button class="ms-3">
                                    {{ __('Siguiente') }}
                                </x-primary-button>
                            </div>
                    </div>
                    </form>
                    
                </div>

            </div>
        </div>
    </div>
</x-app-layout>