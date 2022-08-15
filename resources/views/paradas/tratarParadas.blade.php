@extends("layouts.app")

@section("content")

    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

   
    <!-- librerias cnd para select2 select con opcion de buscar -->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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
                                                    type="date"
                                                    name="fecha_parada"
                                                    id="fecha_parada"
                                                    value="{{ old('fecha_parada') ??  $fecha_parada}}"
                                                    onclick="this.setAttribute('type', 'date');"
                                                    onchange="informacionParadas(this.form)"  
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
                                <th scope="col" class="py-3 px-6">{{ __("Unidad") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Parada") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Motivo") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Ubicación") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Acción") }} </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <select id="id_operacion" name="id_operacion" onchange="llenarUnidades(this.form)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option disabled selected>Selecciona</option>
                                    @foreach ($operaciones as $operacion)
                                    <option value="{{ $operacion->id }}">{{ $operacion->nb_operacion }}</option>

                                    @endforeach

                                </select>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <select id="id_unidad" name="id_unidad" onchange="llenarParadas(this.form)" class="buscarUnidadSelect bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option disabled selected>Selecciona</option>
                                    

                                </select>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <select id="id_parada" name="id_parada" onchange="llenarMotivosParadas(this.form)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option disabled selected>Selecciona</option>
                                    

                                </select>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <select id="id_motivo_parada" name="id_motivo_parada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option  disabled selected>Selecciona</option>
                                    
                                </select>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <input name="ubicacion" id="ubicacion" class="appearance-none bg-gray-200 border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" placeholder="Ingresa la url de maps">  </input>
                                @error("ubicacion")
                                <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                                    {{ $message }}
                                </div>
                                @enderror
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
       <!-- aquí aparece la tabla llamada por ajax -->
    <div class="" name="tabla_paradas" id="tabla_paradas"></div>

       <!-- al cargar la pagina se ejecuta la funcion informacionFlota para cargar la tabla con la fecha por defecto -->
    <body onload="informacionParadas()">
     <script>
   
       function myFunction() {
         console.log("function called...");
       }
   
     </script>
   </body>
<script>


//consultar cedis
function llenarUnidades(theForm) {

var id_operacion = $("#id_operacion").val();


$.ajax({ // create an AJAX call...
    data:  {
        "_token": $("meta[name='csrf-token']").attr("content"),
        id_operacion:id_operacion,

    },

    type: "POST", // GET or POST
    url: "{{ route('paradas.consultarUnidades') }}", // the file to call
    dataType: 'json',   
    success: function(res) {

    if (res) {
        console.log(id_unidad);

        $("#id_unidad").empty();
        $("#id_unidad").append('<option>Seleccionar</option>');
        $.each(res, function(key, value) {
        $("#id_unidad").append('<option value="' +  value.id + '">' + value.nb_unidad +
                    '</option>');
        });



    } else {

        $("#id_unidad").empty();
    }
    }
    
});
}

</script>


<script>
    // In your Javascript (external .js resource or <script> tag)
    //select unidades con opcion de buscar unidad
    $(document).ready(function() {
        $('.buscarUnidadSelect').select2();
    });

</script>

<script>


//consultar paradas
function llenarParadas(theForm) {



$.ajax({ // create an AJAX call...
    data:  {
        "_token": $("meta[name='csrf-token']").attr("content"),

    },

    type: "POST", // GET or POST
    url: "{{ route('paradas.consultarParadas') }}", // the file to call
    dataType: 'json',   
    success: function(res) {

    if (res) {
        console.log(id_parada);

        $("#id_parada").empty();
        $("#id_parada").append('<option>Seleccionar</option>');
        $.each(res, function(key, value) {
        $("#id_parada").append('<option value="' +  value.id + '">' + value.nb_parada +
                    '</option>');
        });



    } else {

        $("#id_parada").empty();
    }
    }
    
});
}

</script>

<script>


//consultar motivo de paradas
function llenarMotivosParadas(theForm) {

    var id_parada = $("#id_parada").val();


$.ajax({ // create an AJAX call...
    data:  {
        "_token": $("meta[name='csrf-token']").attr("content"),
        id_parada:id_parada,

    },

    type: "POST", // GET or POST
    url: "{{ route('paradas.consultarMotivosParadas') }}", // the file to call
    dataType: 'json',   
    success: function(res) {

    if (res) {
        console.log(id_motivo_parada);

        $("#id_motivo_parada").empty();
        $("#id_motivo_parada").append('<option>Seleccionar</option>');
        $.each(res, function(key, value) {
        $("#id_motivo_parada").append('<option value="' +  value.id + '">' + value.nb_motivo_parada +
                    '</option>');
        });



    } else {

        $("#id_motivo_parada").empty();
    }
    }
    
});
}

</script>

<script>


    //generar tabla unidades en ruta a partir de la fecha
    function informacionParadas(theForm) {

    var fecha_parada = $("#fecha_parada").val();



    $.ajax({ // create an AJAX call...
    data:  {
        "_token": $("meta[name='csrf-token']").attr("content"),
        fecha_parada:fecha_parada,



    },

    type: "POST", // GET or POST
        url: "{{ route('paradas.tablaParadas') }}", // the file to call
        dataType: 'html',   
        success: function(tablaParadas) {

        if (tablaParadas) {
            console.log(tablaParadas);

            $('#tabla_paradas').html(tablaParadas);
            //alert("hecho");



        } else {

            $("#tabla_paradas").empty();
        }
        }



    });
    }
</script>


@endsection