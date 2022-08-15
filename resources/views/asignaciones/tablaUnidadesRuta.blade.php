

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg" >
            <table name="example" id="example" class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%">
                <caption class="p-5 text-lg font-semibold justify-center  text-gray-900 bg-white dark:text-white dark:bg-gray-800" >
                    <h1 class="mb-5">@forelse($cedis as $cedi) Unidades en ruta {{$cedi->nb_cedis }} @endforeach {{$fecha_imprimir}}</h1>
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
                    <h1 class="mb-5">@forelse($cedis as $cedi) Otras unidades {{$cedi->nb_cedis }} @endforeach {{$fecha_imprimir}}</h1>
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

    


