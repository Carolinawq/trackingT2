@extends("layouts.app")

@section("content")

   <!-- css local tailwind 1.0 -->
   <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">

   <script src="{{ asset('js/jquery.min.js') }}" defer></script>

<header class="bg-white shadow">

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
  <h1 class="text-3xl font-bold text-gray-900">
    @if($id_operacion == 1) Reportes Pollo Vivo  @endif
    @if($id_operacion == 2) Reportes Pollo Procesado  @endif
  </h1>
</div>
</header>

<form method="POST" action="{{ route('generarReportes') }}" target="_blank">
    @csrf
    <div class="grid grid-cols-12 gap-4 bg-white shadow sm:rounded-md sm:overflow-hidden content-center">
        <div class="col-span-3"></div>
        <div class="col-span-3">
            <div class="antialiased sans-serif">
                <div class="container mx-auto px-8 py-4 md:py-10">
                    <div class="mb-5 w-64">
                        <label class="font-bold mb-1 text-gray-700 block">
                            <span class="text-gray-700">Fecha</span>
                            <div class="antialiased sans-serif">
                                <div class="flex flex-row space-x-4">
                                    <div class="relative z-0 w-full mb-5 mx-auto">
                                        <input
                                        type="text"
                                        name="fecha"
                                        id="fecha"
                                        placeholder=""
                                        onclick="this.setAttribute('type', 'date');"
                                        onchange="llenarCedis(this.form)"
                                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
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
            <div class="col-span-3">
                <div class="antialiased sans-serif">
                    <div class="container mx-auto px-8 py-4 md:py-10">
                        <div class="mb-5 w-64">

                                <span class="text-gray-700">Cedis</span>
                                <select
                                id="id_cedis" 
                                name="id_cedis"
                                class="form-select block w-full mt-1 pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium">
                                </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-3"></div>
            
        </div>

        <input id="id_operacion" name="id_operacion" type="hidden" value="{{$id_operacion}}"/>                   

        <div class="col-span-6 flex justify-center">
            <div class="mb-4">
                <button id="generar_reporte" name="generar_reporte" class="px-4 py-2 rounded-md text-sm font-medium border focus:outline-none focus:ring transition text-red-600 border-red-600 hover:text-white hover:bg-red-600 active:bg-red-700 focus:ring-red-300" type="submit" disabled>Generar reporte</button>
            </div>
        </div>
    </form>




    <style>
                    .-z-1 {
                      z-index: -1;
                    }
                  
                    .origin-0 {
                      transform-origin: 0%;
                    }
                  
                    input:focus ~ label,
                    input:not(:placeholder-shown) ~ label,
                    textarea:focus ~ label,
                    textarea:not(:placeholder-shown) ~ label,
                    select:focus ~ label,
                    select:not([value='']):valid ~ label {
                      /* @apply transform; scale-75; -translate-y-6; */
                      --tw-translate-x: 0;
                      --tw-translate-y: 0;
                      --tw-rotate: 0;
                      --tw-skew-x: 0;
                      --tw-skew-y: 0;
                      transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate))
                        skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
                      --tw-scale-x: 0.75;
                      --tw-scale-y: 0.75;
                      --tw-translate-y: -1.5rem;
                    }
                  
                    input:focus ~ label,
                    select:focus ~ label {
                      /* @apply text-black; left-0; */
                      --tw-text-opacity: 1;
                      color: rgba(0, 0, 0, var(--tw-text-opacity));
                      left: 0px;
                    }

                    .texto-vertical-2 {
                        writing-mode: vertical-lr;
                        transform: rotate(180deg);
                    }
                  </style>

<script>



                    //consultar cedis
                    function llenarCedis(theForm) {

                    var fecha = $("#fecha").val();
                    var id_operacion = "{{$id_operacion}}";

                    //deshabilitar el boton generar reporte
                    let generar_reporte = document.querySelector("#generar_reporte");
                    generar_reporte.disabled = true; 

                    $.ajax({ // create an AJAX call...
                        data:  {
                            "_token": $("meta[name='csrf-token']").attr("content"),
                            id_operacion:id_operacion,
                            fecha:fecha

                        },

                        type: "POST", // GET or POST
                        url: "{{ route('consultarCedis') }}", // the file to call
                        dataType: 'json',   
                        success: function(res) {

                        if (res != '') {
                            console.log(id_cedis);

                            $("#id_cedis").empty();
                            $("#id_cedis").append('<option>Seleccionar</option>')
                            $.each(res, function(key, value) {
                            $("#id_cedis").append('<option value="' +  value.id + '">' + value.nb_cedis +
                                        '</option>');
                            });

                            //habilitar el boton generar reporte
                            generar_reporte.disabled = false; 

                        } else {

                            $("#id_cedis").empty();
                            }
                        }
                        
                    });
                    }
                </script>



<script>









@endsection