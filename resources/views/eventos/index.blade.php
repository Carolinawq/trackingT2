@extends("layouts.app")

@section("content")

    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            <h1 class="mb-5">{{__("Crear eventos") }}</h1>
            <a href="{{ route("eventos.create") }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{__("Crear eventos")}}
            </a>
        </div>
    </div>


    <table class="border-separate border-2 text-center border-gray-500 mt-3" style="width: 100%">
        <thead>
        <tr>
            <th class="px-4 py-2">{{ __("Eventos") }} </th>
            <th class="px-4 py-2">{{ __("Acciones") }} </th>
        </tr>
        
        </thead>

    </tbody>
        @forelse($eventos as $evento)
        <tr>
            <td class="border px-4 py-2">{{ $evento->nb_evento }} </td>

            <td class="border px-4 py-2">
                <a href="{{ route("eventos.edit", [ "evento" =>  $evento ]) }}"  class="text-blue-400"> {{ __("Editar") }} </a>
                <a 
                    href="#"  
                    class="text-red-400"
                    onclick="event.preventDefault();
                        document.getElementById('delete-evento-{{ $evento->id }}-form').submit();"
                    > {{ __("Eliminar") }}
                </a>

                <form id="delete-evento-{{ $evento->id }}-form" action="{{ route("eventos.destroy", ["evento" => $evento]) }}" method="POST" class="hidden">
                    @method("DELETE")
                    @csrf
                </form>
            </td>
        </tr>

        @empty

        <tr>
            <td class="col-span-2">
                <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                    <p><strong class="font-bold">{{ __("No hay eventos") }} </strong><p>
                    <span class="block sm:inline">{{ __("Todavía no hay eventos que mostrar.") }}
                </div>
            </td>
            
        </tr>

        @endforelse
        </tbody>
    </table>

    @if($eventos->count())
        <div class="mt-3">
            {{ $eventos->links() }}
        </div>
    @endif


@endsection