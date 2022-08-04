@extends("layouts.app")

@section("content")

   <!-- css local tailwind 1.0 -->
   <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">

   <script src="{{ asset('js/jquery.min.js') }}" defer></script>

   

    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            <h1 class="mb-5">{{__("Asignaciones PV") }}</h1>
            <a href="{{ route("cedis.create") }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{__("Crear cedi")}}
            </a>
        </div>
    </div>
    <form method="POST" action="" target="_blank">
    @csrf
    <div class="grid grid-cols-12 gap-4 bg-white shadow sm:rounded-md sm:overflow-hidden content-center">
        <div class="col-span-3"></div>
        <div class="col-span-3">
            <div class="antialiased sans-serif">
                <div class="container mx-auto px-8 py-4 md:py-10">
                    <div class="mb-5 w-64">
                        <label class="font-bold mb-1 text-gray-700 block"></label>
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
                        <label class="font-bold mb-1 text-gray-700 block">
                            <span class="text-gray-700">Cedis</span>
                            <select
                            id="cedis" 
                            name="cedis"
                            onclick="this.setAttribute('type', 'string');"  
                            class="form-select block w-full mt-1 pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium">
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-3"></div>
    </div>
    </form>

        <!-- aquí empieza el codigo util -->
<br>
 
    <div class="max-w-5xl mx-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-4">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>                    
                    <form class="flex items-center">
                    <input type="search" name="buscarCedi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Buscar por cedi"
                                value="{{ $buscarCedi ?? ''}}" >
                    </form>

                </div>
            </div>







        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table name="example" id="example" class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%">
                <caption class="p-5 text-lg font-semibold justify-center  text-gray-900 bg-white dark:text-white dark:bg-gray-800" >
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Operaciones activas.</p>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">{{ __("Cedi") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Operación") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Asignaciones") }} </th>
                    </tr>
                </thead>
            <tbody>
                @forelse($cedis as $cedi)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="border px-4 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ $cedi->nb_cedis }}</td>
                    <td class="border px-4 py-2 font-medium text-gray-600 dark:text-white whitespace-nowrap">{{ $cedi->nb_operacion }}</td>

                    <td class="border px-4 py-2">
                        <a href="{{ route("asignaciones.edit", [ "asignacione" =>  $cedi->id, "operacione" =>  $operacion ]) }}"  class="text-blue-400"> {{ __("Agregar/editar") }} </a>

                    </td>
                </tr>

                @empty
                <tr>
                    <td class="col-span-2">
                        <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                            <p><strong class="font-bold">{{ __("No hay operaciones") }} </strong><p>
                                <span class="block sm:inline">{{ __("Todavía no hay operaciones que mostrar.") }}

                        </div>
                    </td>
                </tr>

            </tbody>
            @endforelse
            </table>
        </div>
    </div>
</div>







        <!--estilo del datepicker -->

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




        <!--consultar cedis-->
        <script>
        function llenarCedis(theForm) {
            var fecha = $("#fecha").val();

            $.ajax({ // create an AJAX call...
                data:  {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    fecha:fecha
                },
                type: "POST", // GET or POST
                url: "{{ route('asignacionesPV.consultarAsignacionesDeLaFecha') }}", // the file to call
                dataType: 'json',   
                success: function(res) {
                    if (res != '') {
                        console.log(cedis);
                        $("#cedis").empty();
                        $("#cedis").append('<option>Seleccionar</option>')
                        $.each(res, function(key, value) {
                            $("#cedis").append('<option value="' +  value.nb_cedis + '">' + value.nb_cedis +
                            '</option>');
                        });

                    } else {
                        $("#cedis").empty();
                    }
                }
            });
        }
        </script>

    <script>



@endsection