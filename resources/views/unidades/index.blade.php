@extends("layouts.app")

@section("content")

    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            <h1 class="mb-5">{{__("Centros nueva unidad") }}</h1>
            <a href="{{ route("unidades.create") }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{__("Crear unidad")}}
            </a>
        </div>
    </div>


    <table class="border-separate border-2 text-center border-gray-500 mt-3" style="width: 100%">
        <thead>
        <tr>
            <th class="px-4 py-2">{{ __("Económico") }} </th>
            <th class="px-4 py-2">{{ __("Operación") }} </th>
            <th class="px-4 py-2">{{ __("Estatus") }} </th>
            <th class="px-4 py-2">{{ __("Fecha de creación") }} </th>
            <th class="px-4 py-2">{{ __("Acciones") }} </th>
        </tr>
        
        </thead>

    </tbody>
        @forelse($unidades as $unidade)
        <tr>
            <td class="border px-4 py-2">{{ $unidade->nb_unidad }} </td>
            <td class="border px-4 py-2">{{ $unidade->nb_operacion }}</td>
            <td class="border px-4 py-2">@if($unidade->isActive == 1) {{__("Activada")}} @else {{__("Desactivada")}} @endif </td>
            <td class="border px-4 py-2">{{ date('d-m-Y', strtotime($unidade->created_at)) }}</td>

            <td class="border px-4 py-2">
                <a href="{{ route("unidades.edit", [ "unidade" =>  $unidade->id ]) }}"  class="text-blue-400"> {{ __("Editar") }} </a>
                <a 
                    href="#"  
                    class="text-red-400"
                    onclick="event.preventDefault();
                        document.getElementById('delete-unidade-{{ $unidade->id }}-form').submit();"
                    > {{ __("Eliminar") }}
                </a>

                <form id="delete-unidade-{{ $unidade->id }}-form" action="{{ route("unidades.destroy", ["unidade" => $unidade->id ]) }}" method="POST" class="hidden">
                    @method("DELETE")
                    @csrf
                </form>
            </td>
        </tr>

        @empty

        <tr>
            <td class="col-span-2">
                <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                    <p><strong class="font-bold">{{ __("No hay unidades") }} </strong><p>
                    <span class="block sm:inline">{{ __("Todavía no hay unidades que mostrar.") }}
                </div>
            </td>
            
        </tr>

        @endforelse
        </tbody>
    </table>




@endsection