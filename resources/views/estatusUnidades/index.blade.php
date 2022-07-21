@extends("layouts.app")

@section("content")

    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            <h1 class="mb-5">{{__("Crear estatus de unidades") }}</h1>
            <a href="{{ route("estatusUnidades.create") }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{__("Crear estatus")}}
            </a>
        </div>
    </div>


    <table class="border-separate border-2 text-center border-gray-500 mt-3" style="width: 100%">
        <thead>
        <tr>
            <th class="px-4 py-2">{{ __("Estatus") }} </th>
            <th class="px-4 py-2">{{ __("Estado del estatus") }} </th>
            <th class="px-4 py-2">{{ __("Acciones") }} </th>
        </tr>
        
        </thead>

    </tbody>
        @forelse($estatusUnidades as $estatus)
        <tr>
            <td class="border px-4 py-2">{{ $estatus->nb_estatus }} </td>
            <td class="border px-4 py-2">@if($estatus->isActive == 1)  Activada  @else Desactivada @endif </td>

            <td class="border px-4 py-2">
                <a href="{{ route("estatusUnidades.edit", [ "estatusUnidade" =>  $estatus ]) }}"  class="text-blue-400"> {{ __("Editar") }} </a>
                <a 
                    href="#"  
                    class="text-red-400"
                    onclick="event.preventDefault();
                        document.getElementById('delete-estatusUnidade-{{ $estatus->id }}-form').submit();"
                    > {{ __("Eliminar") }}
                </a>

                <form id="delete-cedi-{{ $estatus->id }}-form" action="{{ route("estatusUnidades.destroy", ["estatusUnidade" => $estatusUnidades]) }}" method="POST" class="hidden">
                    @method("DELETE")
                    @csrf
                </form>
            </td>
        </tr>

        @empty

        <tr>
            <td class="col-span-2">
                <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                    <p><strong class="font-bold">{{ __("No hay estatus") }} </strong><p>
                    <span class="block sm:inline">{{ __("Todavía no hay estatus que mostrar.") }}
                </div>
            </td>
            
        </tr>

        @endforelse
        </tbody>
    </table>

    @if($estatusUnidades->count())
        <div class="mt-3">
            {{ $estatusUnidades->links() }}
        </div>
    @endif


@endsection