<x-app-layout>


    <div class="py-5">

        <div class="row justify-content-md-center">
            <div class="col col-sm-auto col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <p>
                                Ingresa el numero de DUI de tu compañero para poder registrar un permiso con sus datos,
                                recuerda que al finalizar el registro quedara en el historial de tu compañero.
                            </p>
                        </div>
                        <div class="row">
                            <div class="my-2">
                                <form action="{{ route('permiso.create') }}" method="get">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="bi bi-person-vcard"></i>
                                        </span>
                                        <input type="text" id="dui" name="dui" class="form-control" placeholder="Digite el numero de DUI"
                                            aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Siguiente</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

        {{-- <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <p>
                                Ingresa el numero de DUI de tu compañero para poder registrar un permiso con sus datos,
                        recuerda que al finalizar el registro quedara en el historial de tu compañero.
                            </p>
                        </div>
                        <div class="row">
                            <div class="my-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-person-vcard"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Digite el numero de DUI" aria-label="Username" aria-describedby="basic-addon1">
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
        </div> --}}



    </div>
</x-app-layout>
