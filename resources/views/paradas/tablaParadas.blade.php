

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg" >
            <table name="example" id="example" class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%">
                <caption class="p-5 text-lg font-semibold justify-center  text-gray-900 bg-white dark:text-white dark:bg-gray-800" >
                    <h1 class="mb-5">@foreach($operacionPolloVivo as $operacionVivo) Paradas operación {{$operacionVivo->nb_operacion }} @endforeach {{$fecha_parada_imprimir}}</h1>
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Paradas registradas.</p>
                </caption>

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">{{ __("#") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Cedi") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Unidad") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Motivo parada") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Parada") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Ubicación") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Acción") }} </th>
                    </tr>
                </thead>
            @forelse($paradasPolloVivo as $paradasVivo)

            <tbody>
            @if($paradasVivo->nb_parada == 'Parada autorizada')
            <tr class="bg-white text-blue-700 border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="border px-4 py-2">{{ $paradasVivo->id }}</td>
                <td class="border px-4 py-2">{{ $paradasVivo->nb_cedis }}</td>
                <td class="border px-4 py-2">{{ $paradasVivo->nb_unidad }}</td>
                <td class="border px-4 py-2">{{ $paradasVivo->nb_motivo_parada }}</td>
                <td class="border px-4 py-2">{{ $paradasVivo->nb_parada }}</td>
                <td class="border px-4 py-2 text-blue-600/100">
                    <p class="text-blue-600/100">
                        <a href="{{ url($paradasVivo->ubicacion) }}" target="_blank" class="underline">Ver ubicación</a>
                    </p>
                </td>
                <td class="border px-4 py-2">
                    <a 
                        href="#"  
                        class="text-red-400"
                        onclick="event.preventDefault();
                            document.getElementById('delete-paradaVivo-{{ $paradasVivo->id }}-form').submit();"
                        > {{ __("Eliminar") }}
                    </a>


                    <form id="delete-paradaVivo-{{ $paradasVivo->id }}-form" action="{{ route("paradas.destroy", ["parada" => $paradasVivo->id ]) }}" method="POST" class="hidden">
                        @method("DELETE")
                        @csrf
                    </form>

                </td>
            </tr>
            @elseif($paradasVivo->nb_parada == 'Parada no autorizada')
            <tr class="bg-white text-red-600 border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="border px-4 py-2">{{ $paradasVivo->id }}</td>
                <td class="border px-4 py-2">{{ $paradasVivo->nb_cedis }}</td>
                <td class="border px-4 py-2">{{ $paradasVivo->nb_unidad }}</td>
                <td class="border px-4 py-2">{{ $paradasVivo->nb_motivo_parada }}</td>
                <td class="border px-4 py-2">{{ $paradasVivo->nb_parada }}</td>
                <td class="border px-4 py-2 text-blue-600/100">
                    <p class="text-blue-600/100">
                        <a href="{{ url($paradasVivo->ubicacion) }}" target="_blank" class="underline">Ver ubicación</a>
                    </p>
                </td>
                <td class="border px-4 py-2">
                    <a 
                        href="#"  
                        class="text-red-400"
                        onclick="event.preventDefault();
                            document.getElementById('delete-paradaVivo-{{ $paradasVivo->id }}-form').submit();"
                        > {{ __("Eliminar") }}
                    </a>


                    <form id="delete-paradaVivo-{{ $paradasVivo->id }}-form" action="{{ route("paradas.destroy", ["parada" => $paradasVivo->id ]) }}" method="POST" class="hidden">
                        @method("DELETE")
                        @csrf
                    </form>

                </td>
            </tr>
            @endif

                @empty

                <tr>
                    <td class="col-span-12">
                        <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                            <p><strong class="font-bold">{{ __("No paradas registradas de pollo vivo") }} </strong><p>
                            <span class="block sm:inline">{{ __("Todavía no hay paradas que mostrar.") }}
                        </div>
                    </td>
                </tr>
            </tbody>
            @endforelse

        </table>
    </div>

    <br>


    <div class="overflow-x-auto relative shadow-md sm:rounded-lg" >
            <table name="example" id="example" class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%">
                <caption class="p-5 text-lg font-semibold justify-center  text-gray-900 bg-white dark:text-white dark:bg-gray-800" >
                    <h1 class="mb-5">@foreach($operacionPolloProcesado as $operacionProcesado) Paradas operación {{$operacionProcesado->nb_operacion }} @endforeach {{$fecha_parada_imprimir}}</h1>
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Paradas registradas.</p>
                </caption>

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 ">{{ __("#") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Cedi") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Unidad") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Motivo parada") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Parada") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Ubicación") }} </th>
                        <th scope="col" class="py-3 px-6">{{ __("Acción") }} </th>
                    </tr>
                </thead>
            @forelse($paradasPolloProcesado as $paradasProcesado)

            <tbody>
            @if($paradasProcesado->nb_parada == 'Parada autorizada')
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="border px-4 py-2">{{ $paradasProcesado->id }}</td>
                <td class="border px-4 py-2">{{ $paradasProcesado->nb_cedis }}</td>
                <td class="border px-4 py-2">{{ $paradasProcesado->nb_unidad }}</td>
                <td class="border px-4 py-2">{{ $paradasProcesado->nb_motivo_parada }}</td>
                <td class="border px-4 py-2">{{ $paradasProcesado->nb_parada }}</td>
                <td class="border px-4 py-2">
                    <p class="text-blue-600/100">
                        <a href="{{ url($paradasProcesado->ubicacion) }}" target="_blank" class="underline">Ver ubicación</a>
                    </p>
                </td>

                <td class="border px-4 py-2">
                    <a 
                        href="#"  
                        class="text-red-400"
                        onclick="event.preventDefault();
                            document.getElementById('delete-paradaProcesado-{{ $paradasProcesado->id }}-form').submit();"
                        > {{ __("Eliminar") }}
                    </a>


                    <form id="delete-paradaVivo-{{ $paradasProcesado->id }}-form" action="{{ route("paradas.destroy", ["parada" => $paradasProcesado->id ]) }}" method="POST" class="hidden">
                        @method("DELETE")
                        @csrf
                    </form>

                </td>
            </tr>
            @elseif($paradasProcesado->nb_parada == 'Parada no autorizada')
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="border px-4 py-2">{{ $paradasProcesado->id }}</td>
                <td class="border px-4 py-2">{{ $paradasProcesado->nb_cedis }}</td>
                <td class="border px-4 py-2">{{ $paradasProcesado->nb_unidad }}</td>
                <td class="border px-4 py-2">{{ $paradasProcesado->nb_motivo_parada }}</td>
                <td class="border px-4 py-2">{{ $paradasProcesado->nb_parada }}</td>
                <td class="border px-4 py-2">
                    <p class="text-blue-600/100">
                        <a href="{{ url($paradasProcesado->ubicacion) }}" target="_blank" class="underline">Ver ubicación</a>
                    </p>
                </td>

                <td class="border px-4 py-2">
                    <a 
                        href="#"  
                        class="text-red-400"
                        onclick="event.preventDefault();
                            document.getElementById('delete-paradaProcesado-{{ $paradasProcesado->id }}-form').submit();"
                        > {{ __("Eliminar") }}
                    </a>


                    <form id="delete-paradaVivo-{{ $paradasProcesado->id }}-form" action="{{ route("paradas.destroy", ["parada" => $paradasProcesado->id ]) }}" method="POST" class="hidden">
                        @method("DELETE")
                        @csrf
                    </form>

                </td>
            </tr>
            @endif

                @empty

                <tr>
                    <td class="col-span-12">
                        <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                            <p><strong class="font-bold">{{ __("No paradas registradas de pollo procesado") }} </strong><p>
                            <span class="block sm:inline">{{ __("Todavía no hay paradas que mostrar.") }}
                        </div>
                    </td>
                </tr>
            </tbody>
            @endforelse

        </table>
    </div>
    <br>
