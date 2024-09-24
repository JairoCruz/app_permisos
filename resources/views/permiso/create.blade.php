<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar permiso') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('errorss'))
                <div class="bg-red-100 border border-red-400 text-red-700 mb-2 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">{{  session()->get('errorss')}}</strong>
                    <span class="block sm:inline">Por favor verificar.</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
                
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Form -->
                    <form action="{{ route('permiso.store') }}" method="POST" class="w-full">
                        @csrf
                        <!-- <div class="flex flex-wrap -mx-3 mb-2">

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

                        </div> -->

                        <div class="flex flex-wrap -mx-3 mb-4">

                            <div class="w-full md:w-1/4 px-3">
                                <label class="block font-medium text-xs text-gray-700"
                                    for="grid-fecha-registro">
                                    Fecha de registro
                                </label>
                                <input
                                    class="w-full border-gray-400 h-8 mt-1 text-xs focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                    id="grid-fecha-registro" type="date" value="{{ date('Y-m-d', time()) }}"
                                    name="fecha_registro"
                                    readonly="true">
                            </div>

                            <div class="w-full md:w-3/4 px-3">
                                <label class="block font-medium text-xs text-gray-700"
                                    for="grid-nombre-empleado">
                                    Nombre del empleado solicitante
                                </label>
                                <input
                                    class="w-full lowercase border-gray-400 h-8 mt-1 text-xs focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                    id="grid-nombre-empleado" type="text"
                                    value="{{ $d_empleado->empleado }}" readonly="true">
                            </div>


                        </div>

                        <div class="flex flex-wrap -mx-3 mb-4">

                            <div class="w-full md:w-1/4 px-3">
                                <label class="block font-medium text-xs text-gray-700"
                                    for="grid-fecha-presentacion">
                                    Fecha de presentacion
                                </label>
                                <input
                                    class="w-full border-gray-400 text-xs h-8 mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                    id="grid-fecha-presentacion" type="date" name="fecha_presentacion" value="{{ old('fecha_presentacion') }}" required>
                                    <x-input-error :messages="$errors->get('fecha_presentacion')" class="mt-2" />
                            </div>


                            <div class="w-full md:w-3/4 px-3">
                                <label class="block font-medium text-xs text-gray-700"
                                    for="grid-pertenece">
                                    Unidad
                                </label>
                                <input
                                    class="w-full lowercase border-gray-400 h-8 text-xs mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                    id="grid-pertenece" type="text" placeholder="Unidad de talento humano"
                                    value="{{ $d_empleado->unidad }}" readonly="true">
                            </div>

                        </div>


                        <div class="flex flex-wrap -mx-3 mb-4">

                            <div class="w-full md:w-1/4 px-3">
                                <label class="block font-medium text-xs text-gray-700"
                                    for="grid-tipo-permiso">
                                    Tipo de permiso
                                </label>

                                <div class="relative">
                                    <select
                                        class="w-full border-gray-400 h-8 text-xs mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                        id="grid-tipo-permiso" name="tipo_permiso" required>
                                        <option value="" hidden>seleccione una opcion</option>
                                        @foreach ($tipo_permisos as $t_permiso)
                                            <option value="{{ $t_permiso->cod_permiso }}" 
                                            {{ old('tipo_permiso') == $t_permiso->cod_permiso ? 'selected' : ''}}>
                                                {{ $t_permiso->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('tipo_permiso')" class="text-xs" />
                                </div>
                            </div>


                            <div class="w-full md:w-1/4 px-3">
                                <label class="block font-medium text-xs text-gray-700"
                                    for="grid-goce-sueldo">
                                    Goce de sueldo
                                </label>

                                <div class="relative">
                                    <select
                                        class="w-full border-gray-400 h-8 text-xs mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                        id="grid-goce-sueldo" name="goce_sueldo" required>
                                        <option value="" hidden>seleccione una opcion</option>
                                        @foreach ($opciones as $opcion => $op )
                                        <option value="{{ $opcion }}"
                                        {{ old('goce_sueldo') == $opcion ? 'selected' : ''}}
                                        >
                                            {{ $op }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('goce_sueldo')" class="text-xs" />
                                </div>
                            </div>

                            <div class="w-full md:w-1/4 px-3">
                                <label class="block font-medium text-xs text-gray-700"
                                    for="grid-constancia">
                                    Constancia
                                </label>

                                <div class="relative">
                                    <select
                                        class="w-full border-gray-400 h-8 text-xs mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                        id="grid-constancia" name="constancia" required>
                                        <option selected value hidden>seleccione una opcion</option>
                                        @foreach ($opciones as $opcion => $op )
                                        <option value="{{ $opcion }}"
                                        {{ old('constancia') == $opcion ? 'selected' : '' }}
                                        >
                                            {{ $op }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('constancia')" class="text-xs" />
                                </div>
                            </div>

                        </div>

                        <div class="flex flex-wrap -mx-3 mb-2">
                        <!-- 1 -->
                            <div class="w-full md:w-1/2">
                                <div class="flex flex-wrap">
                                    <div class="w-full md:w-1/2 px-3 mb-4">
                                        <label
                                            class="block font-medium text-xs text-gray-700"
                                            for="grid-fecha-inicio">
                                            Fecha de inicio
                                        </label>
                                        <input
                                            class="w-full border-gray-400 h-8 text-xs mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                            id="grid-fecha-inicio" type="date" name="fecha_inicial" value="{{ old('fecha_inicial') }}" required>
                                            <x-input-error :messages="$errors->get('fecha_inicial')" class="text-xs"/>
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-4">
                                        <label
                                            class="block font-medium text-xs text-gray-700"
                                            for="grid-hora-inicio">
                                            Hora de inicio
                                        </label>
                                        <input
                                            class="w-full h-3/5 border-gray-400 h-8 text-xs mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                            id="grid-hora-inicio" type="time" min="08:00" max="16:00" name="hora_inicial" value="{{ old('hora_inicial') }}" required>
                                            <x-input-error :messages="$errors->get('hora_inicial')" class="text-xs"/>
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mt-3 mb-4">
                                        <label
                                            class="block font-medium text-xs text-gray-700"
                                            for="grid-fecha-fin">
                                            Fecha de fin
                                        </label>
                                        <input
                                            class="w-full border-gray-400 h-8 text-xs mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                            id="grid-fecha-fin" type="date" name="fecha_final" value="{{ old('fecha_final') }}" required>
                                            <x-input-error :messages="$errors->get('fecha_final')" class="text-xs"/>
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mt-3 mb-4">
                                        <label
                                            class="block font-medium text-xs text-gray-700"
                                            for="grid-hora-fin">
                                            Hora de fin
                                        </label>
                                        <input
                                            class="w-full h-3/5 border-gray-400 h-8 text-xs mt-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm leading-tight"
                                            id="grid-hora-fin" type="time" name="hora_final" min="08:00" max="16:00" value="{{ old('hora_final') }}" required>
                                            <x-input-error :messages="$errors->get('hora_final')" class="text-xs"/>
                                    </div>
                                </div>
                            </div>
                            <!-- 2 -->
                            <div class="w-full md:w-1/2">

                                <div class="w-full px-3 mb-6">
                                    <label class="block font-medium text-xs text-gray-700"
                                        for="grid-motivo">
                                        Motivo
                                    </label>
                                    <textarea                                    
                                        class="resize-none block w-full text-xs h-28 border-gray-400 rounded-md leading-tight mt-1 focus:border-indigo-500 focus:ring-indigo-500  shadow-sm"
                                        id="grid-motivo" name="motivo" required>
                                        @if (old('motivo'))
                                        {{ old('motivo') }}
                                        @endif
                                        
                                    </textarea>
                                        <x-input-error :messages="$errors->get('motivo')" class="text-xs"/>
                                </div>

                            </div>
                        </div>

                        <div class="flex flex-wrap flex-row-reverse -mx-3 mb-2">
                            <div class="w-full  md:w-1/4 px-3 mb-2 md:mb-0">
                                <button
                                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                    Guardar
                                </button>
                            </div>

                            <div class="w-full md:w-1/4 px-3 mb-2 md:mb-0">
                            
                                <a href="{{ route('permiso.index') }}" class="w-full h-full inline-block content-center text-center  border text-gray-500 hover:text-gray-800 text-sm py-1 px-2 rounded">
                                    Cancelar
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
