<div class="w-full max-w-lg">
    <div class="flex flex-wrap">
        <h1 class="mb-5">{{ $title }}</h1>
        
    </div>

    <form class="w-full max-w-lg " method="POST" action="{{ $route }}"> 
    @csrf
    @isset($update)
        @method("PUT")
    @endisset
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            {{ __("Crear centro de distribución") }}
            </label>


            <input name="nb_cedis" value=" {{ old("nb_cedis") ?? $cedi->nb_cedis }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leadind.tight focus:outline-none focus:bg-white focus:border-gray-500 h-12 resize-none" id="nb_cedis"> {{ old("nb_cedis") ?? $cedi->nb_cedis }} </input>
            <p class="text-gray-600 text-xs italic"> {{  __("Nombre del centro operación")  }} </p>
            @error("nb_cedis")
            <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                {{ $message }}
            </div>
            @enderror

            <label class="mt-6 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                {{ __("Ubicación del centro de distribución") }}
            </label>

            <input name="nb_ubicacion" value=" {{ old("nb_ubicacion") ?? $cedi->nb_ubicacion }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leadind.tight focus:outline-none focus:bg-white focus:border-gray-500 h-12 resize-none" id="nb_ubicacion"> {{ old("nb_ubicacion") ?? $cedi->nb_ubicacion }} </input>
            <p class="text-gray-600 text-xs italic"> {{  __("Ubicación")  }} </p>
            @error("nb_ubicacion")
            <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                {{ $message }}
            </div>
            @enderror

        </div>
    </div>

    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Selecciona la operación</label>
    <select id="id_operacion" name="id_operacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected>Escoge la operación</option>
        <option {{old('id_operacion',$cedi->id_operacion)=="1" ? 'selected':''}}  value="1">Pollo Vivo</option>
        <option {{old('id_operacion',$cedi->id_operacion)=="2" ? 'selected':''}}  value="2">Pollo Procesado</option>
    </select>

    <label for="isActive" class="mt-6 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Selecciona el estatus</label>
    <select id="isActive" name="isActive" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected>Estatus</option>
        <option {{old('isActive',$cedi->isActive)=="0" ? 'selected':''}}  value="0">Desactivado</option>
        <option {{old('isActive',$cedi->isActive)=="1" ? 'selected':''}}  value="1">Activado</option>
    </select>

    <div class="mt-3 md:flex md:items-center">
        <div class="md:w-1/3">
            <button class="shadow bg-teal-400 hover;bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                {{ $textButton }}
            </button>
        </div>
    </div>        
    </form>


    


</div>
