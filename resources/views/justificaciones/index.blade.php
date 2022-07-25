@extends("layouts.app")

@section("content")

    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            <h1 class="mb-5">{{__("Crear justificación") }}</h1>
            <a href="{{ route("justificaciones.create") }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{__("Crear justificación")}}
            </a>
        </div>
    </div>


    <table class="border-separate border-2 text-center border-gray-500 mt-3" style="width: 100%">
        <thead>
        <tr>
            <th class="px-4 py-2">{{ __("Evento") }} </th>
            <th class="px-4 py-2">{{ __("Justificación") }} </th>
            <th class="px-4 py-2">{{ __("Estado de la justificación del evento") }} </th>
            <th class="px-4 py-2">{{ __("Fecha de creación") }} </th>
            <th class="px-4 py-2">{{ __("Acciones") }} </th>
        </tr>
        
        </thead>

    </tbody>
        @forelse($justificaciones as $justificacione)
        <tr>
            <td class="border px-4 py-2">{{ $justificacione->nb_evento }}</td>

            <td class="border px-4 py-2">{{ $justificacione->nb_justificacion }} </td>
            <td class="border px-4 py-2">@if($justificacione->isActive == 1)  Activada  @else Desactivada @endif </td>
            <td class="border px-4 py-2">{{ date('d-m-Y', strtotime($justificacione->created_at)) }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route("justificaciones.edit", [ "justificacione" =>  $justificacione->id  ]) }}"  class="text-blue-400"> {{ __("Editar") }} </a>
                <a 
                    href="#"  
                    class="text-red-400"
                    onclick="event.preventDefault();
                        document.getElementById('delete-justificacione-{{ $justificacione->id }}-form').submit();"
                    > {{ __("Eliminar") }}
                </a>

                <form id="delete-justificacione-{{ $justificacione->id }}-form" action="{{ route("justificaciones.destroy", ["justificacione" => $justificacione->id]) }}" method="POST" class="hidden">
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