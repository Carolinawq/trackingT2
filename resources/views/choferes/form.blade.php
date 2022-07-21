
    <form class="w-full max-w-lg"  method="POST" action="{{ $route }}">

        @csrf
        @isset($update)
            @method("PUT")
        @endisset

        <div class="flex flex-wrap">
            <h1 class="mb-5">{{ $title }}</h1>
            
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nb_chofer">
              Nombre(s)
            </label>
            <input value=" {{ old("nb_chofer") ?? $chofere->nb_chofer }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="nb_chofer" name="nb_chofer" type="text" placeholder="Nombres">
            @error("nb_chofer")
                <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                    {{ $message }}
                </div>
            @enderror
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nb_chofer_a_paterno">
              Apellido paterno
            </label>
            <input value=" {{ old("nb_chofer_a_paterno") ?? $chofere->nb_chofer_a_paterno }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nb_chofer_a_paterno" id="nb_chofer_a_paterno" type="text" placeholder="Apellidos">
            @error("nb_chofer_a_paterno")
                <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                    {{ $message }}
                </div>
            @enderror
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-2">
          
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
              Cedi
            </label>
            <div class="relative">
              <select id="id_cedis" name="id_cedis" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option  selected>Selecciona</option>
                @foreach ($consultarCedis as $item)
                    <option {{old('id_cedis', $item->id)==$chofere->id_cedis  ? 'selected':''}} value="{{ $item->id }}">{{ $item->nb_cedis }}</option>
                @endforeach
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
              </div>
            </div>
          </div>
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-no_empleado">
              No. de colaborador
            </label>
            <input value=" {{ old("no_empleado") ?? $chofere->no_empleado }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="no_empleado" name="no_empleado" type="text" placeholder="01234">
            @error("no_empleado")
                <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                    {{ $message }}
                </div>
            @enderror
          </div>
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mt-2">

                <label for="isActive" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">¿El operador esta activo?</label>
                <select id="isActive" name="isActive" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Selecciona</option>
                    <option {{old('isActive',$chofere->isActive)=="0" ? 'selected':''}}  value="0">No</option>
                    <option {{old('isActive',$chofere->isActive)=="1" ? 'selected':''}}  value="1">Si</option>
                </select>
            </div>

        </div>

        <div class="md:flex md:items-center">
            <div class="md:w-1/3">
                <button class="shadow bg-teal-400 hover;bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    {{ $textButton }}
                </button>
            </div>
        </div>   
    </form>
