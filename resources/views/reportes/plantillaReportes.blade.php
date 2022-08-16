
<!-- css local tailwind 1.0 -->
<link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">

<link href="{{ asset('css/format.css') }}" rel="stylesheet">


<!-- Scripts local datepicker 
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
<script src="{{ asset('js/jquery.min.js') }}"></script>



<script src="{{ asset('js/loader.js') }}"></script>


<meta name="csrf-token" content="{{ csrf_token() }}">


<style>
.cuerpoEventos {
height: 890px;
width: 1218px;
background-color: white;
}
.cuerpoInformacionFlota {
height: 895px;
width: 1218px;
background-color: white;
}

.cuerpoHabitosConduccion {
height: 895px;
width: 1218px;
background-color: white;
}
.cuerpoIncidenciasRuta {
height: 895px;
width: 1218px;
background-color: white;
}

.footer {
width: 1218px;
}

.border {
border:2px solid black;
border-radius:22px;
margin: 4px;
}

.logoBachoco{
position:absolute;

margin: 7px;


}

.alto-titulo {
    height: 80px;

}


.velocidadUno{
height: 513px;
background-color: white;
}


.altoVelocidades{
height: 335px;
background-color: white;
}

.velocidadDos{
height: 152px;
background-color: white;
}

.altoVelocidadDosTres{
height: 380px;
background-color: white;
}

.altoEventos{
height: 400px;
background-color: white;
}
</style>

<!--eventos de seguridad-->
<div class="cuerpoEventos border bg-white">

    <div class="grid grid-cols-12 mb-0">
        <div class="col-span-3 flex justify-center items-center m-2 mb-0" style="height: 50px" ><img src="{{URL::asset('/images/logo-bachoco.png')}}" style="height: 30px;"></div>


        <div class="col-span-6 flex justify-center items-center text-3xl" style="height: 50px">
            <p class="font-sans md:font-serif" >
                Eventos de seguridad @foreach($cedis as $cedi) {{$cedi->nb_cedis}}  @endforeach @foreach($operacion as $opera) {{$opera->nb_operacion}} @endforeach
            </p>
        </div>
        <div class="col-span-3 flex justify-center items-center mr-2 ml-0 text-sm" style="align-content: right">
            <p class="font-sans md:font-serif font-bold"><br>
            Torre de monitoreo T2&nbsp;
            </p>
            <img src="{{URL::asset('/images/torre-monitoreo.png')}}" style="height: 40px; ">
        </div>    

    </div>

    <div class="grid grid-cols-12 gap-2 m-2 altoEventos" style="border: 1px solid #ff4040"">


            <div id="eventos" style="border: 1px solid #000" class="col-span-8 flex justify-center items-center m-2" ></div>

                    <div id="" style="border: 1px solid #000" class="col-span-4 flex justify-center items-center m-2">
                        <p class="font-sans md:font-serif" >
                            <center> JUSTIFICACIÓN <br>
                        </p>
                        @isset($agruparEventos)
                            <center> 
                            @foreach($agruparEventos as $row)
                            <p class="font-sans md:font-serif text-base"> {{$row->nb_evento}}:</p> <p class="font-sans md:font-serif text-sm"> {{$row->nb_justificacion}}<br></p>
                            @endforeach
                        @endisset

                        @empty($agruparEventos)
                            <center><p class="font-sans md:font-serif text-base ">Sin alertamientos registrados.</p>
                        @endempty
                    
                    
                    </div>
            </div>

            <div id="descripcionEventos" style="border: 1px solid #000" class="col-span-12 flex justify-center items-center m-2" ></div>


</div>
<div class="footer bg-white">

    <div class="grid grid-cols-12 m-0 text-xs">
        <div class="col-span-9 text-sm ml-2">
            <p class="font-sans md:font-serif text-left ">
                Duración horas:minutos:segundos. 
                Dudas y comentarios con tu analista en turno.
            </p>
        </div>
        
        <div class="col-span-3 text-sm mr-2">
            <p class="text-right font-sans md:font-serif ">Fecha de operación: {{$fechaDMY}}</p>
        </div>

    </div>
</div>




<!--eventos de seguridad-->

<script>

//generar eventos                            
$(document).ready(function(){
//hacemos focus al campo de búsqueda

var fecha = '{{$fecha}}';
var id_operacion = '{{$id_operacion}}';
var id_cedis = '{{$id_cedis}}';

function generarEventos(){          
    //hace la búsqueda
    $.ajax({


data: {
    "_token": $("meta[name='csrf-token']").attr("content"),
    id_operacion:id_operacion,
    fecha:fecha,
    id_cedis:id_cedis
},
type: "POST", // GET or POST
    url: "{{ route('reportes.eventosSeguridad') }}", // the file to call
    dataType: 'html',   
    success: function(eventosSeguridad) {

    if (eventosSeguridad) {
        console.log(eventosSeguridad);

        $('#eventos').html(eventosSeguridad);
        alert("Eventos listos!");



    } else {

        $("#eventos").empty();
    }
    }



});
}

generarEventos();

});

//generar tabla descripcion eventos                            
$(document).ready(function(){
//hacemos focus al campo de búsqueda

var fecha = '{{$fecha}}';
var id_operacion = '{{$id_operacion}}';
var id_cedis = '{{$id_cedis}}';

function generarDescripcionEventos(){          
    //hace la búsqueda
    $.ajax({


data: {
    "_token": $("meta[name='csrf-token']").attr("content"),
    id_operacion:id_operacion,
    fecha:fecha,
    id_cedis:id_cedis
},
type: "POST", // GET or POST
    url: "{{ route('reportes.descripcionEventos') }}", // the file to call
    dataType: 'html',   
    success: function(descripcionEventos) {

    if (descripcionEventos) {
        console.log(descripcionEventos);

        $('#descripcionEventos').html(descripcionEventos);
        alert("Descripción de eventos listos!");



    } else {

        $("#descripcionEventos").empty();
    }
    }



});
}

generarDescripcionEventos();

});

</script>