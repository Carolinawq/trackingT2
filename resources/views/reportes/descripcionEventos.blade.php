
    <div id="app">
      <div class="w-full bg-gray-50">
        <h1 class='text-2xl font-bold text-center'>Detalles</h1>
        <h2 class='text-lg text-center'>
    </h2>
        <div class="flex w-full justify-center">
          <table class="table-fixed border-gray-500 w-4/5 mx-12 mt-14">
            <thead class="">
              <tr class="border-b-2 border-black">
                <th class="w-4/12 bg-gray-300 text-left px-2">Unidad</th>
                <th class="w-4/12 bg-gray-300 text-left px-2">Evento</th>
                <th class="w-4/12 bg-gray-300 text-left px-2">Hora inicio</th>
                <th class="w-4/12 bg-gray-300 text-left px-2">Hora fin</th>
                <th class="w-4/12 bg-gray-300 text-left px-2">Duración</th>
                <th class="w-4/12 bg-gray-300 text-left px-2">Ubicación inicial</th>
                <th class="w-4/12 bg-gray-300 text-left px-2">Ubicación final</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-400">
            @foreach ($agruparEventos as $row)

              <tr>
                <td class="text-left px-2">{{$row->nb_unidad}}</td>
                <td class="text-left px-2">
                  <p class="text-sm">
                    {{$row->nb_evento}}
                  </p>
                </td>
                <td class="px-2">{{$row->hora_inicial}}</td>
                <td class="px-2">{{$row->hora_final}}</td>
                <td class="px-2">{{$row->duracion_evento}}</td>
                <td class="px-2">
                  <p class="underline text-blue-600 text-sm">
                    <a href="{{$row->ubicacion_inicial}}"  target="_blank">Ir.</a>.
                  </p>
                </td>
                <td class="px-2">
                  <p class="underline text-blue-600 text-sm">
                    <a href="{{$row->ubicacion_final}}"  target="_blank">Ir.</a>.
                  </p>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
    
 