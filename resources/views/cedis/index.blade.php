@extends("layouts.app")

@section("content")

    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            <h1 class="mb-5">{{__("Centros de distribución") }}</h1>
            <a href="{{ route("cedis.create") }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{__("Crear cedi")}}
            </a>
        </div>
    </div>

    @forelse($cedis as $cedi)
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="width: 100%">
        <caption class="p-5 text-lg font-semibold justify-center  text-gray-900 bg-white dark:text-white dark:bg-gray-800" >{{ 'Cedi: '. $cedi->nb_cedis }}
        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
        </caption>
        
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6">{{ __("Pollo Vivo") }} </th>
            <th scope="col" class="py-3 px-6">{{ __("Pollo Procesado") }} </th>
            <th scope="col" class="py-3 px-6">{{ __("Acciones") }} </th>
        </tr>
        
        </thead>


    </tbody>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="border px-4 py-2"></td>
            <td class="border px-4 py-2"></td>

            <td class="border px-4 py-2">
                <a href="{{ route("cedis.edit", [ "cedi" =>  $cedi->id ]) }}"  class="text-blue-400"> {{ __("Editar") }} </a>
                <a 
                    href="#"  
                    class="text-red-400"
                    onclick="event.preventDefault();
                        document.getElementById('delete-cedi-{{ $cedi->id }}-form').submit();"
                    > {{ __("Eliminar") }}
                </a>

                <form id="delete-cedi-{{ $cedi->id }}-form" action="{{ route("cedis.destroy", ["cedi" => $cedi->id]) }}" method="POST" class="hidden">
                    @method("DELETE")
                    @csrf
                </form>
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
    </table>
    </div>
@endforelse


    @if($cedis->count())
        <div class="mt-3">
            {{ $cedis->links() }}
        </div>
    @endif


@endsection