@extends("layouts.app")

@section("content")

<link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


   <form method="POST" enctype="multipart/form-data"  action="{{$route}}">
                        @csrf
                        @isset($update)
                            @method("PUT")
                        @endisset
   <div class="flex justify-center sm:rounded-lg relative">
                <div class="mb-3 xl:w-96">
                    <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                        <div class="col-span-12">
                            <div class="antialiased sans-serif">
                                <div class="container mx-auto px-8 py-4 md:py-10 bg-white">
                                    <div class="mb-5 w-64">
                                        <label class="font-bold mb-1 text-gray-700 block"></label>
                                            <span class="text-gray-700">Fecha</span>
                                            <div class="antialiased sans-serif">
                                                <div class="flex flex-row space-x-4">
                                                    <div class="relative z-0 w-full mb-5 mx-auto">
                                                    <input
                                                    type="text"
                                                    name="fecha_parada"
                                                    id="fecha_parada"
                                                    value="{{ old('fecha_parada') ??  $fecha_parada}}"
                                                    onclick="this.setAttribute('type', 'date');"
                                                    onchange="informacionFlota(this.form)"
                                                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                                                    required
                                                    />
                                                    <label for="date" class="absolute duration-300 top-6 -z-1 origin-0 text-gray-700">Date</label>
                                                    <span class="text-sm text-red-600 hidden" id="error">Date is required</span>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg" >
                    <table name="example" id="example" class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%">
                        <caption class="p-5 text-lg font-semibold justify-center  text-gray-900 bg-white dark:text-white dark:bg-gray-800" >
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Registra una nueva parada para el ...</p>
                        </caption>

                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">{{ __("Operación") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Cedi") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Unidad") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Parada") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Motivo") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Ubicación") }} </th>
                            </tr>
                        </thead>
                        <tbody>





                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <select id="id_operacion" name="id_operacion" onchange="llenarCedis(this.form)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option disabled selected>Selecciona</option>
                                    @foreach ($operaciones as $operacion)
                                    <option value="{{ $operacion->id }}">{{ $operacion->nb_operacion }}</option>

                                    @endforeach

                                </select>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <label class="font-bold mb-1 text-gray-700 block">
                                                <select
                                                id="id_cedis" 
                                                name="id_cedis"
                                                onclick="this.setAttribute('type', 'string');"  
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                </select>
                                                <option  disabled selected>Selecciona</option>

                                            </label>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <select id="id_ruta" name="id_ruta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option  disabled selected>Selecciona</option>
                                    
                                </select>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <select id="id_chofer" name="id_chofer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option  disabled selected>Selecciona</option>
                                    
                                </select>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <div class="md:w-1/3">
                                    <button class="shadow bg-teal-400 hover;bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                        {{ $textButton }}
                                    </button>
                                </div>
                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>
            </form>

    <br>

 

<script>


//consultar cedis
function llenarCedis(theForm) {

var id_operacion = $("#id_operacion").val();


$.ajax({ // create an AJAX call...
    data:  {
        "_token": $("meta[name='csrf-token']").attr("content"),
        id_operacion:id_operacion,

    },

    type: "POST", // GET or POST
    url: "{{ route('paradas.consultarCedis') }}", // the file to call
    dataType: 'json',   
    success: function(res) {

    if (res) {
        console.log(id_cedis);

        $("#id_cedis").empty();
        $("#id_cedis").append('<option>Seleccionar</option>');
        $.each(res, function(key, value) {
        $("#id_cedis").append('<option value="' +  value.id + '">' + value.nb_cedis +
                    '</option>');
        });



    } else {

        $("#id_cedis").empty();
    }
    }
    
});
}

</script>


@endsection