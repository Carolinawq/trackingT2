@extends("layouts.app")

@section("content")

   <!-- css local tailwind 1.0 -->


   <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            @foreach ($cedis as $cedi)
            <h1 class="mb-5">{{__("Asignaciones  $cedi->nb_cedis") }}</h1>
            
            @endforeach
        </div>
    </div>

    <form method="POST" action="{{ $route }}" >
            @csrf
            @isset($update)
                @method("PUT")
            @endisset

            <!--se envia de nuevo la variable con el id del cedis para volver a la vista de agregar asignacion -->
            @foreach ($cedis as $cedi)
            <input id="id_cedis" name="id_cedis" type="hidden" value="{{ $cedi->id }}" >
            @endforeach
            <!--se envia de nuevo la variable con el id de la operación para volver a la vista de agregar asignacion -->
            <input id="id_operacion" name="id_operacion" type="hidden" value="{{ $id_operacion }}" >

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
                                            placeholder=""
                                            onclick="this.setAttribute('type', 'date');"
                                            onchange="llenarCedis(this.form)"
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
    <br>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg" >
            <table name="example" id="example" class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%">
                <caption class="p-5 text-lg font-semibold justify-center  text-gray-900 bg-white dark:text-white dark:bg-gray-800" >
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Escoge los datos de la asignación.</p>
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
                </form>
        


            </tbody>
        </table>
    </div>

        <br>
        <!--tabla de asignacion  -->
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg" >
            <table name="example" id="example" class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%">
                <caption class="p-5 text-lg font-semibold justify-center  text-gray-900 bg-white dark:text-white dark:bg-gray-800" >
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Unidades en ruta.</p>
                </caption>

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">{{ __("#") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Unidad") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Vuelta") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Estatus") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Chofer") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Tipo ruta") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Acción") }} </th>

                    </tr>
                </thead>
            @forelse($consultarAsignaciones as $consultarAsignacion)

            <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="border px-4 py-2">{{ $consultarAsignacion->id }}</td>
                <td class="border px-4 py-2">{{ $consultarAsignacion->nb_unidad }}</td>
                <td class="border px-4 py-2">{{ $consultarAsignacion->no_vuelta }}</td>
                <td class="border px-4 py-2">{{ $consultarAsignacion->nb_estatus }}</td>
                <td class="border px-4 py-2">{{ $consultarAsignacion->nb_chofer.' '.$consultarAsignacion->nb_chofer_a_paterno }}</td>
                <td class="border px-4 py-2">{{ $consultarAsignacion->nb_ruta }}</td>

                <td class="border px-4 py-2">
                    <a 
                        href="#"  
                        class="text-red-400"
                        onclick="event.preventDefault();
                            document.getElementById('delete-asignacion-{{ $consultarAsignacion->id }}-form').submit();"
                        > {{ __("Eliminar") }}
                    </a>

                    <form id="delete-asignacion-{{ $consultarAsignacion->id }}-form" action="{{ route("asignaciones.destroy", ["asignacione" => $consultarAsignacion->id]) }}" method="POST" class="hidden">
                        @method("DELETE")
                        @csrf
                    </form>
                </td>
            </tr>

                @empty

                <tr>
                    <td class="col-span-12">
                        <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                            <p><strong class="font-bold">{{ __("No asignaciones registradas") }} </strong><p>
                            <span class="block sm:inline">{{ __("Todavía no hay asiginaciones que mostrar.") }}
                        </div>
                    </td>
                </tr>
            </tbody>
            @endforelse

        </table>
    </div>

    <br>

            <!--tabla de otras unidades (unidades que no estan en ruta) -->
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table name="example" id="example" class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%">
                <caption class="p-5 text-lg font-semibold justify-center  text-gray-900 bg-white dark:text-white dark:bg-gray-800" >
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Otras unidades (Prestamo, taller, baja, baja demanda).</p>
                </caption>

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">{{ __("#") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Unidad") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Estatus") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Acción") }} </th>

                    </tr>
                </thead>
            @forelse($consultarOtrasUnidades as $consultarOtraUnidad)
            <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="border px-4 py-2">{{ $consultarOtraUnidad->id }}</td>
                <td class="border px-4 py-2">{{ $consultarOtraUnidad->nb_unidad }}</td>
                <td class="border px-4 py-2">{{ $consultarOtraUnidad->nb_estatus }}</td>

                <td class="border px-4 py-2">
                    <a 
                        href="#"  
                        class="text-red-400"
                        onclick="event.preventDefault();
                            document.getElementById('delete-otrasunidades-{{ $consultarOtraUnidad->id }}-form').submit();"
                        > {{ __("Eliminar") }}
                    </a>

                    <form id="delete-otrasunidades-{{ $consultarOtraUnidad->id }}-form" action="{{ route("asignaciones.destroy", ["asignacione" => $consultarOtraUnidad->id]) }}" method="POST" class="hidden">
                        @method("DELETE")
                        @csrf
                    </form>
                </td>
            </tr>

                @empty

                <tr>
                    <td class="col-span-12">
                        <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                            <p><strong class="font-bold">{{ __("No otras unidades registradas") }} </strong><p>
                            <span class="block sm:inline">{{ __("Todavía no hay otras unidades que mostrar.") }}
                        </div>
                    </td>
                </tr>
            </tbody>
            @endforelse

        </table>
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

        <script>

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




@endsection

