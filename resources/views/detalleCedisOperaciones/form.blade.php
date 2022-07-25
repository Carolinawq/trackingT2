<div class="w-full max-w-lg">
    <div class="flex flex-wrap">
        <h1 class="mb-5">{{ $title }}</h1>
        
    </div>

    <form class="w-full max-w-lg " method="POST" action="{{ $route }}"> 
    @csrf
    @isset($update)
        @method("PUT")
    @endisset

    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mt-2">
        <label for="nb_cedis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Seleccion el cedis</label>

        <select id="id_cedis" name="id_cedis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option  selected>Selecciona</option>
          @foreach ($consultarCedis as $item)
              <option {{old('id_cedis', $item->id)==$detalleCedisOperacione->id_cedis  ? 'selected':''}} value="{{ $item->id }}">{{ $item->nb_cedis }}</option>
          @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
    </div>

    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mt-2">
        <label for="nb_cedis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Seleccion la operación</label>

        <select id="id_operacion" name="id_operacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option  selected>Selecciona</option>
          @foreach ($consultarOperaciones as $item)
              <option {{old('id_operacion', $item->id)==$detalleCedisOperacione->id_operacion  ? 'selected':''}} value="{{ $item->id }}">{{ $item->nb_operacion }}</option>
          @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
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



    


</div>
