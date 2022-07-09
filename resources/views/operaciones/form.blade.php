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
                {{ __("Operación") }}
                </label>


                <input name="nb_operacion" value=" {{ old("nb_operacion") ?? $operacione->nb_operacion }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leadind.tight focus:outline-none focus:bg-white focus:border-gray-500 h-12 resize-none" id="nb_operacion"> {{ old("nb_operacion") ?? $operacione->nb_operacion }} </input>
                <p class="text-gray-600 text-xs italic"> {{  __("Nombre de la operación")  }} </p>
                @error("nb_operacion")
                <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                    {{ $message }}
                </div>
                @enderror
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
</div>