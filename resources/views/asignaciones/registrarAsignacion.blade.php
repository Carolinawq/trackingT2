@extends("layouts.app")

@section("content")

   <!-- css local tailwind 1.0 -->


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
                                                    name="fecha_ruta"
                                                    id="fecha_ruta"
                                                    value="{{ old('fecha_ruta') ??  $fecha_ruta}}"
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
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Ingresa la asignación para @foreach ($cedis as $cedi) {{ $cedi->nb_cedis }} @endforeach</p>
                        </caption>

                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">{{ __("Unidad") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Estatus") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Tipo ruta") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Chofer") }} </th>
                                <th scope="col" class="py-3 px-6">{{ __("Acciones") }} </th>

                            </tr>
                        </thead>
                        <tbody>



                        <input id="id_operacion" name="id_operacion" type="hidden" value="{{ $id_operacion }}" >
                        <input id="id_cedis" name="id_cedis" type="hidden" value="{{ $id_cedis }}" >


                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <select id="id_unidad" name="id_unidad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option disabled selected>Selecciona</option>
                                    @foreach ($unidades as $unidad)
                                    <option value="{{ $unidad->id }}">{{ $unidad->nb_unidad }}</option>

                                    @endforeach

                                </select>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <select id="id_estatus_unidades" name="id_estatus_unidades" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option disabled selected>Selecciona</option>
                                    @foreach ($estatusUnidades as $estatusUnidad) 
                                        <option value="{{ $estatusUnidad->id }}">{{ $estatusUnidad->nb_estatus }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <select id="id_ruta" name="id_ruta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option  disabled selected>Selecciona</option>
                                    @foreach ($rutas as $ruta) 
                                        <option value="{{ $ruta->id }}">{{ $ruta->nb_ruta }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <select id="id_chofer" name="id_chofer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option  disabled selected>Selecciona</option>
                                    @foreach ($choferes as $chofer) 
                                        <option value="{{ $chofer->id }}">{{ $chofer->nb_chofer. ' '.$chofer->nb_chofer_a_paterno }}</option>
                                    @endforeach
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

 



   <div class="" name="tabla_unidades_ruta" id="tabla_unidades_ruta"></div>
 


    <body onload="informacionFlota()">
     <script>
   
       function myFunction() {
         console.log("function called...");
       }
   
     </script>
   </body>
<script>
    //deahabilita selects cuando el estatus de unidad sea diferente a ruta
        let chofer = document.querySelector("#id_chofer");
        chofer.disabled = true;
                        
        let ruta = document.querySelector("#id_ruta");
        ruta.disabled = true;

        let estatus = document.querySelector("#id_estatus_unidades");
        estatus.disabled = false;

        $("#id_estatus_unidades").change(function() {
            if($("#id_estatus_unidades").val() == "1"){
                chofer.disabled = false;
                ruta.disabled = false;
            }else{
                chofer.disabled = true;
                ruta.disabled = true;
            }
        });
    </script>

<script>


//generar tabla unidades en ruta a partir de la fecha
function informacionFlota(theForm) {

var fecha_ruta = $("#fecha_ruta").val();
var id_operacion = $("#id_operacion").val();
var id_cedis = $("#id_cedis").val();



$.ajax({ // create an AJAX call...
data:  {
    "_token": $("meta[name='csrf-token']").attr("content"),
    operacion:id_operacion,
    fecha_ruta:fecha_ruta,
    id_cedis:id_cedis,



},

type: "POST", // GET or POST
    url: "{{ route('asignaciones.tablaUnidadesRuta') }}", // the file to call
    dataType: 'html',   
    success: function(tablaUnidadesRuta) {

    if (tablaUnidadesRuta) {
        console.log(tablaUnidadesRuta);

        $('#tabla_unidades_ruta').html(tablaUnidadesRuta);
        //alert("hecho");



    } else {

        $("#tabla_unidades_ruta").empty();
    }
    }



});
}
</script>

@endsection