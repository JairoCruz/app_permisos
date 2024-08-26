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
                    <form class="w-full">
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
                                    id="grid-digitador" type="text" placeholder="juan juan perez quintanilla"
                                    value="{{ $d_empleado->empleado }}">
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
                                    disabled>
                            </div>


                            <div class="w-full md:w-3/4 px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-nombre-empleado">
                                    nombre del empleado
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-nombre-empleado" type="text" placeholder="juan juan perez quintanilla"
                                    value="{{ $d_empleado->empleado }}">
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
                                    id="grid-fecha-presentacion" type="date">
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
                                        id="grid-tipo-permiso">
                                        <option selected hidden>seleccione una opcion</option>
                                        @foreach ($tipo_permisos as $t_permiso)
                                            <option value="{{ $t_permiso->cod_permiso }}" {{ old('$t_permiso->cod_permiso') == $t_permiso->cod_permiso ? 'selected' : ''}}>
                                                {{ $t_permiso->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                        id="grid-goce-sueldo">
                                        <option selected hidden>seleccione una opcion</option>
                                        <option>si</option>
                                        <option>no</option>
                                    </select>
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
                                        id="grid-constancia" value="no">
                                        <option selected hidden>seleccione una opcion</option>
                                        <option value="si">si</option>
                                        <option value="no">no</option>
                                    </select>
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
                                            id="grid-fecha-inicio" type="date" value="">
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-6">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-fecha-inicio">
                                            hora de inicio
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-fecha-inicio" type="time" value="">
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-6">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-fecha-fin">
                                            Fecha de fin
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-fecha-fin" type="date" value="">
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-6">
                                        <label
                                            class="block uppercase tracking-wide text-gray-600 text-xs font-bold mb-2"
                                            for="grid-hora-fin">
                                            hora de fin
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-hora-fin" type="time" value="">
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
                                        class="appearance-none resize-none block w-full h-36 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-fecha-inicio" type="date" value="">
                                        </textarea>
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
