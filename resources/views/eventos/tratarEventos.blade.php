@extends("layouts.app")

@section("content")

<link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- librerias cnd para select2 select con opcion de buscar -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>





<form method="POST" enctype="multipart/form-data"  action="{{$route}}">
        @csrf
        @isset($update)
            @method("PUT")
        @endisset
   <div class="flex justify-center sm:rounded-lg relative">
                <div class="mb-3 xl:w-96">
                    <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                        <div class="col-span-12">
                            <div class="antialiased sans-serif">
                                <div class="container mx-auto px-8 py-4 md:py-10 bg-white">
                                    <div class="mb-5 w-64">
                                        <label class="font-bold mb-1 text-gray-700 block"></label>
                                            <span class="text-gray-700">Fecha</span>
                                            <div class="antialiased sans-serif">
                                                <div class="flex flex-row space-x-4">
                                                    <div class="relative z-0 w-full mb-5 mx-auto">
                                                    <input
                                                    type="date"
                                                    name="fecha_evento"
                                                    id="fecha_evento"
                                                    value="{{ old('fecha_evento') ??  $fecha_evento}}"
                                                    onclick="this.setAttribute('type', 'date');"
                                                    onchange="informacionEventos(this.form)"
                                                    class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                                                    required
                                                    />
                                                    <span class="text-sm text-red-600 hidden" id="error">Date is required</span>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <br>

    <div class="bg-gray-100 mx-auto max-w-6xl bg-white py-20 px-12 lg:px-24 shadow-xl mb-24">

      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
      <div class="-mx-3 md:flex mb-6">
          <div class="md:w-full px-3">
            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="application-link">
              Operación*
            </label>
            <select  required id="id_operacion" name="id_operacion" onchange="llenarUnidades(this.form)" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" disabled selected>Selecciona</option>
                @foreach ($operaciones as $operacion)
                    <option value="{{ $operacion->id }}">{{ $operacion->nb_operacion }}</option>
                @endforeach
            </select>
            @error("id_operacion")
            <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="-mx-3 md:flex mb-2">
            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="location">
              Unidad*
            </label>
            <div>
            <select required id="id_unidad" name="id_unidad" onchange="llenarEventos(this.form)" class="mt-1 buscarUnidadSelect bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="" disabled selected>Selecciona</option>
            </select>
            @error("id_unidad")
            <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                {{ $message }}
            </div>
            @enderror
            </div>
          </div>
          <div class="md:w-1/2 px-3">
            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="job-type">
              Evento*
            </label>
            <div>
            <select required id="id_evento" name="id_evento" onchange="llenarJustificacionEvento(this.form)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="">Selecciona</option>
            </select>
            @error("id_evento")
            <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                {{ $message }}
            </div>
            @enderror
            </div>
          </div>
          <div class="md:w-1/2 px-3">
            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="department">
              Justificación*
            </label>
            <div>
            <select required id="id_justificacion" name="id_justificacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="" disabled selected>Selecciona</option>
            </select>
            @error("id_justificacion_evento")
            <div class="border border-red-400 rounded-b bg-red-100 mt-1 px-4 py-3 text-red-700">
                {{ $message }}
            </div>
            @enderror
            </div>
          </div>
        </div>
        <div class="-mx-3 md:flex mb-2">
          <div class="md:w-full px-3">
            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="application-link">
              Ubicación inicial*
            </label>
            <input required id="ubicacion_inicial" name="ubicacion_inicial" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-1 px-2 mb-4" id="application-link" type="text" placeholder="http://....">
          </div>
        </div>
        <div class="-mx-3 md:flex mb-2">
          <div class="md:w-full px-3">
            <label class="uppercase tracking-wide text-black text-xs font-bold mb-3" for="application-link">
              Ubicación final
            </label>
            <input id="ubicacion_final" name="ubicacion_final" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-1 px-4 mb-4" id="application-link" type="text" placeholder="http://....">
          </div>
        </div>
        <div class="-mx-3 md:flex mb-6">
          <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="company">
              Hora inicial*
            </label>
            <input required id="hora_inicial" name="hora_inicial" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"  type="time">
          </div>
          <div class="md:w-1/2 px-3">
            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="title">
              Hora fin
            </label>
            <input required id="hora_final" name="hora_final" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="title" type="time">
          </div>
        </div>
        <div class="mb-6">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Descripción/comentarios del evento</label>
            <textarea required id="descripcion" name="descripcion" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>
        </div>
        <div class="-mx-3 md:flex mt-2">
          <div class="md:w-full px-3">
            <button class="md:w-full bg-teal-400 hover;bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 border-gray-500 hover:border-gray-100 rounded-full">
            {{ $textButton }}
            </button>
          </div>
        </div>
      </div>
  </div>
</form>


    

<script>
//consultar cedis
function llenarUnidades(theForm) {

var id_operacion = $("#id_operacion").val();


$.ajax({ // create an AJAX call...
    data:  {
        "_token": $("meta[name='csrf-token']").attr("content"),
        id_operacion:id_operacion,

    },

    type: "POST", // GET or POST
    url: "{{ route('eventos.consultarUnidades') }}", // the file to call
    dataType: 'json',   
    success: function(res) {

    if (res) {
        console.log(id_unidad);

        $("#id_unidad").empty();
        $("#id_unidad").append('<option value="">Seleccionar</option>');
        $.each(res, function(key, value) {
        $("#id_unidad").append('<option value="' +  value.id + '">' + value.nb_unidad +
                    '</option>');
        });



    } else {

        $("#id_unidad").empty();
    }
    }
    
});
}

</script>

<script>
    // In your Javascript (external .js resource or <script> tag)
    //select unidades con opcion de buscar unidad
    $(document).ready(function() {
        $('.buscarUnidadSelect').select2();
    });

</script>

<script>
//consultar eventos
function llenarEventos(theForm) {



$.ajax({ // create an AJAX call...
    data:  {
        "_token": $("meta[name='csrf-token']").attr("content"),

    },

    type: "POST", // GET or POST
    url: "{{ route('eventos.consultarEventos') }}", // the file to call
    dataType: 'json',   
    success: function(res) {

    if (res) {
        console.log(id_evento);

        $("#id_evento").empty();
        $("#id_evento").append('<option value="">Seleccionar</option>');
        $.each(res, function(key, value) {
        $("#id_evento").append('<option value="' +  value.id + '">' + value.nb_evento +
                    '</option>');
        });



    } else {

        $("#id_evento").empty();
    }
    }
    
});
}

</script>

<script>


//consultar justificacion de evento
function llenarJustificacionEvento(theForm) {

    var id_evento = $("#id_evento").val();


$.ajax({ // create an AJAX call...
    data:  {
        "_token": $("meta[name='csrf-token']").attr("content"),
        id_evento:id_evento,

    },

    type: "POST", // GET or POST
    url: "{{ route('eventos.consultarJustificacionEventos') }}", // the file to call
    dataType: 'json',   
    success: function(res) {

    if (res) {
        console.log(id_justificacion);

        $("#id_justificacion").empty();
        $("#id_justificacion").append('<option value="">Seleccionar</option>');
        $.each(res, function(key, value) {
        $("#id_justificacion").append('<option value="' +  value.id + '">' + value.nb_justificacion +
                    '</option>');
        });



    } else {

        $("#id_justificacion").empty();
    }
    }
    
});
}

</script>


@endsection