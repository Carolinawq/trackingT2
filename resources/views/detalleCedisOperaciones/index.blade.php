@extends("layouts.app")

@section("content")

    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            <h1 class="mb-5">{{__("Asignar operaciones a cedis") }}</h1>
            <a href="{{ route("detalleCedisOperaciones.create") }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{__("Asignar operaciones")}}
            </a>
        </div>
    </div>


    <table class="border-separate border-2 text-center border-gray-500 mt-3" style="width: 100%">
        <thead>
        <tr>
            <th class="px-4 py-2">{{ __("Cedis") }} </th>
            <th class="px-4 py-2">{{ __("Operaciones") }} </th>
            <th class="px-4 py-2">{{ __("Fecha de creación") }} </th>
            <th class="px-4 py-2">{{ __("Acciones") }} </th>
        </tr>
        
        </thead>

    </tbody>
        @forelse($detalleCedisOperaciones as $detalleCedisOperacione)
        <tr>
            <td class="border px-4 py-2">{{ $detalleCedisOperacione->nb_cedis }}</td>

            <td class="border px-4 py-2">{{ $detalleCedisOperacione->nb_operacion }} </td>
            <td class="border px-4 py-2">{{ date('d-m-Y', strtotime($detalleCedisOperacione->created_at)) }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route("detalleCedisOperaciones.edit", [ "detalleCedisOperacione" =>  $detalleCedisOperacione->id  ]) }}"  class="text-blue-400"> {{ __("Editar") }} </a>
                <a 
                    href="#"  
                    class="text-red-400"
                    onclick="event.preventDefault();
                        document.getElementById('delete-detalleCedisOperacione-{{ $detalleCedisOperacione->id }}-form').submit();"
                    > {{ __("Eliminar") }}
                </a>

                <form id="delete-detalleCedisOperacione-{{ $detalleCedisOperacione->id }}-form" action="{{ route("detalleCedisOperaciones.destroy", ["detalleCedisOperacione" => $detalleCedisOperacione->id]) }}" method="POST" class="hidden">
                    @method("DELETE")
                    @csrf
                </form>
            </td>
        </tr>

        @empty

        <tr>
            <td class="col-span-2">
                <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                    <p><strong class="font-bold">{{ __("No hay justificaciones") }} </strong><p>
                    <span class="block sm:inline">{{ __("Todavía no hay justificaciones que mostrar.") }}
                </div>
            </td>
            
        </tr>

        @endforelse
        </tbody>
    </table>

    <!--falta la opcion de paginar-->


@endsection