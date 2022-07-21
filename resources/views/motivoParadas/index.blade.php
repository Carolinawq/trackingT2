@extends("layouts.app")

@section("content")

    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            <h1 class="mb-5">{{__("Crear motivos de paradas de unidades") }}</h1>
            <a href="{{ route("motivoParadas.create") }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{__("Crear motivo de paradas")}}
            </a>
        </div>
    </div>


    <table class="border-separate border-2 text-center border-gray-500 mt-3" style="width: 100%">
        <thead>
        <tr>
            <th class="px-4 py-2">{{ __("Parada") }} </th>
            <th class="px-4 py-2">{{ __("Motivo") }} </th>
            <th class="px-4 py-2">{{ __("Estado del motivo de la parada") }} </th>
            <th class="px-4 py-2">{{ __("Fecha de creación") }} </th>
            <th class="px-4 py-2">{{ __("Acciones") }} </th>
        </tr>
        
        </thead>

    </tbody>
        @forelse($motivoParadas as $motivoParada)
        <tr>
            <td class="border px-4 py-2">{{ $motivoParada->nb_parada }}</td>

            <td class="border px-4 py-2">{{ $motivoParada->nb_motivo_parada }} </td>
            <td class="border px-4 py-2">@if($motivoParada->isActive == 1)  Activada  @else Desactivada @endif </td>
            <td class="border px-4 py-2">{{ date('d-m-Y', strtotime($motivoParada->created_at)) }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route("motivoParadas.edit", [ "motivoParada" =>  $motivoParada->id  ]) }}"  class="text-blue-400"> {{ __("Editar") }} </a>
                <a 
                    href="#"  
                    class="text-red-400"
                    onclick="event.preventDefault();
                        document.getElementById('delete-motivoParada-{{ $motivoParada->id }}-form').submit();"
                    > {{ __("Eliminar") }}
                </a>

                <form id="delete-motivoParada-{{ $motivoParada->id }}-form" action="{{ route("motivoParadas.destroy", ["motivoParada" => $motivoParada->id]) }}" method="POST" class="hidden">
                    @method("DELETE")
                    @csrf
                </form>
            </td>
        </tr>

        @empty

        <tr>
            <td class="col-span-2">
                <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                    <p><strong class="font-bold">{{ __("No hayparadas") }} </strong><p>
                    <span class="block sm:inline">{{ __("Todavía no hay paradas que mostrar.") }}
                </div>
            </td>
            
        </tr>

        @endforelse
        </tbody>
    </table>

    <!--falta la opcion de paginar-->


@endsection