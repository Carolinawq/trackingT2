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
            {{ __("Crear nuevo estatus") }}
            </label>


            <input name="nb_estatus" value=" {{ old("nb_estatus") ?? $estatusUnidade->nb_estatus }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leadind.tight focus:outline-none focus:bg-white focus:border-gray-500 h-12 resize-none" id="nb_estatus"> {{ old("nb_estatus") ?? $estatusUnidade->nb_estatus }} </input>
            <p class="text-gray-600 text-xs italic"> {{  __("Nombre del estatus")  }} </p>
            @error("nb_estatus")
            <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                {{ $message }}
            </div>
            @enderror

        </div>
    </div>
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mt-2">

        <label for="isActive" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">¿Activar el estatus de la unidad?</label>
        <select id="isActive" name="isActive" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Selecciona</option>
            <option {{old('isActive',$estatusUnidade->isActive)=="0" ? 'selected':''}}  value="0">No</option>
            <option {{old('isActive',$estatusUnidade->isActive)=="1" ? 'selected':''}}  value="1">Si</option>
        </select>
    </div>

    <div class="mt-3 md:flex md:items-center">
        <div class="md:w-1/3">
            <button class="shadow bg-teal-400 hover;bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                {{ $textButton }}
            </button>
        </div>
    </div>        
    </form>


    


</div>
