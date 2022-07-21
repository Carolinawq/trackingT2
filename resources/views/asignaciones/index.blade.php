@extends("layouts.app")

@section("content")

    <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
        <div class="text-center">
            <h1 class="mb-5">{{__("Escoge el cedis al que desear agregar la asignación de choferes") }}</h1>
            <a href="" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                {{__("")}}
            </a>
        </div>
    </div>


    <table class="border-separate border-2 text-center border-gray-500 mt-3" style="width: 100%">
        <thead>
        <tr>
            <th class="px-4 py-2">{{ __("#") }} </th>
            <th class="px-4 py-2">{{ __("Unidad") }} </th>
            <th class="px-4 py-2">{{ __("Chofer") }} </th>
            <th class="px-4 py-2">{{ __("Ruta") }} </th>
        </tr>
        
        </thead>

    </tbody>
        <tr>
            <td class="border px-4 py-2"></td>
            <td class="border px-4 py-2"></td>
            <td class="border px-4 py-2"></td>

            <td class="border px-4 py-2">
                <a href=""  class="text-blue-400"> {{ __("Editar") }} </a>
                <a 
                    href="#"  
                    class="text-red-400"
                    onclick="event.preventDefault();
                        document.getElementById('delete-cedi--form').submit();"
                    > {{ __("Eliminar") }}
                </a>

                <form id="delete-cedi--form" action="" method="POST" class="hidden">
                    @method("DELETE")
                    @csrf
                </form>
            </td>
        </tr>


        <tr>
            <td class="col-span-2">
                <div class="bg-red-100 text-center border border-red-400 text-red-700 px-4 py-4 ">
                    <p><strong class="font-bold">{{ __("Aún no hay asignaciones para hoy") }} </strong><p>
                    <span class="block sm:inline">{{ __("Todavía no hay asignaciones que mostrar.") }}
                </div>
            </td>
            
        </tr>

        </tbody>
    </table>




@endsection