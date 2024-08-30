<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar permiso') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Form -->
                    <form action="{{ route('permiso.store') }}" method="POST" class="w-full">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-2">

                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <label for="grid-num-permiso"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    n° de permiso
                                </label>
                                <input id="grid-num-permiso" placeholder="pendiente asignar" type="text"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                            </div>

                            <div class="w-full md:w-3/4 px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-digitador">
                                    Digitador
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-digitador" name="digitador" type="text" placeholder="juan juan perez quintanilla"
                                    value="{{ $d_empleado->empleado }}" readonly="true">
                            </div>

                        </div>

                        <div class="flex flex-wrap -mx-3 mb-2">

                            <div class="w-full md:w-1/4 px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-fecha-registro">
                                    Fecha de registro
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-fecha-registro" type="date" value="{{ date('Y-m-d', time()) }}"
                                    name="fecha_registro"
                                    readonly="true">
                            </div>


                            <div class="w-full md:w-3/4 px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-nombre-empleado">
                                    nombre del empleado
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-nombre-empleado" type="text" placeholder="juan juan perez quintanilla"
                                    value="{{ $d_empleado->empleado }}" readonly="true">
                            </div>


                        </div>

                        <div class="flex flex-wrap -mx-3 mb-2">

                            <div class="w-full md:w-1/4 px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-fecha-presentacion">
                                    fecha de presentacion
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-fecha-presentacion" type="date" name="fecha_presentacion" value="{{ old('fecha_presentacion') }}" required>
                                    <x-input-error :messages="$errors->get('fecha_presentacion')" class="mt-2" />
                            </div>


                            <div class="w-full md:w-3/4 px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-pertenece">
                                    pertenece a
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-pertenece" type="text" placeholder="Unidad de talento humano"
                                    value="{{ $d_empleado->unidad }}">
                            </div>

                        </div>


                        <div class="flex flex-wrap -mx-3 mb-2">

                            <div class="w-full md:w-1/4 px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-tipo-permiso">
                                    tipo de permiso
                                </label>

                                <div class="relative">
                                    <select
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-tipo-permiso" name="tipo_permiso" value="{{ old('tipo_permiso') }}" required>
                                        <option selected value hidden>seleccione una opcion</option>
                                        @foreach ($tipo_permisos as $t_permiso)
                                            <option value="{{ $t_permiso->cod_permiso }}" {{ old('$t_permiso->cod_permiso') == $t_permiso->cod_permiso ? 'selected' : ''}}>
                                                {{ $t_permiso->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('tipo_permiso')" />
                                </div>
                            </div>


                            <div class="w-full md:w-1/4 px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-goce-sueldo">
                                    con goce de sueldo
                                </label>

                                <div class="relative">
                                    <select
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-goce-sueldo" name="goce_sueldo" value="old('goce_sueldo')" required>
                                        <option selected value hidden>seleccione una opcion</option>
                                        <option value="V">si</option>
                                        <option value="F">no</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('goce_sueldo')" />
                                </div>
                            </div>

                            <div class="w-full md:w-1/4 px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-constancia">
                                    con constancia
                                </label>

                                <div class="relative">
                                    <select
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-constancia" name="constancia" value="old('constancia')" required>
                                        <option selected value hidden>seleccione una opcion</option>
                                        <option value="V">si</option>
                                        <option value="F">no</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('constancia')" />
                                </div>
                            </div>

                        </div>

                        <div class="flex flex-wrap -mx-3 mb-2">
                        <!-- 1 -->
                            <div class="w-full md:w-1/2">
                                <div class="flex flex-wrap">
                                    <div class="w-full md:w-1/2 px-3 mb-6">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-fecha-inicio">
                                            Fecha de inicio
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-fecha-inicio" type="date" name="fecha_inicial">
                                            <x-input-error :messages="$errors->get('fecha_inicial')" />
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-6">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-fecha-inicio">
                                            hora de inicio
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-fecha-inicio" type="time" min="08:00" max="16:00" name="hora_inicial" required>
                                            <x-input-error :messages="$errors->get('hora_inicial')" />
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-6">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-fecha-fin">
                                            Fecha de fin
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-fecha-fin" type="date" name="fecha_final">
                                            <x-input-error :messages="$errors->get('fecha_final')" />
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-6">
                                        <label
                                            class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2"
                                            for="grid-hora-fin">
                                            hora de fin
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-hora-fin" type="time" name="hora_final" min="08:00" max="16:00" required>
                                            <x-input-error :messages="$errors->get('hora_final')" />
                                    </div>
                                </div>
                            </div>
                            <!-- 2 -->
                            <div class="w-full md:w-1/2">

                                <div class="w-full px-3 mb-6">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-fecha-inicio">
                                        motivo
                                    </label>
                                    <textarea
                                        class="appearance-none uppercase resize-none block w-full h-36 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-fecha-inicio" name="motivo"></textarea>
                                        <x-input-error :messages="$errors->get('motivo')" />
                                </div>

                            </div>
                        </div>

                        <div class="flex flex-wrap flex-row-reverse -mx-3 mb-2">
                            <div class="w-full md:w-1/4 px-3 mb-2 md:mb-0">
                                <button
                                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                    guardar
                                </button>
                            </div>

                            <div class="w-full md:w-1/4 px-3 mb-2 md:mb-0">
                                <button
                                    class="w-full bg-white hover:bg-gray-200 text-gray-400 font-bold py-2 px-4 border border-blue-700 rounded">
                                    cancelar
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
