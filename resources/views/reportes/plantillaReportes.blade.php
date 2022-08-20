
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
                            <p class="font-sans md:font-serif text-base"> {{$row->nb_evento.'('.$row->total .')'}}: </p> <p class="font-sans md:font-serif text-sm"> {{$row->nb_justificacion}}<br></p>
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


<!--informacion de flota-->

<div class="cuerpoInformacionFlota border bg-white">

<div class="grid grid-cols-12 mb-0">
    <div class="col-span-3 flex justify-center items-center m-2 ml-3 mb-0" style="height: 50px" ><img src="{{URL::asset('/images/logo-bachoco.png')}}" style="height: 30px;"></div>

    <div class="col-span-6 flex justify-center items-center text-3xl">
        <p class="font-sans md:font-serif" >
            Información de flota @foreach($cedis as $cedi) {{$cedi->nb_cedis}}  @endforeach @foreach($operacion as $opera) {{$opera->nb_operacion}} @endforeach
        </p>
    </div>
    <div class="col-span-3 flex justify-center items-center mr-2 ml-0 text-sm" style="align-content: right">
        <p class="font-sans md:font-serif font-bold"><br>
        Torre de monitoreo T2&nbsp;
        </p>
        <img src="{{URL::asset('/images/torre-monitoreo.png')}}" style="height: 40px; ">
    </div>

</div>


    <div class="grid grid-cols-12 gap-1 m-2 mt-0" style="border: 1px solid #ff4040">
        
        <div class="col-span-5 m-2" id="disponibilidad" style="border: 1px solid #000"></div>
        <div class="col-span-7 m-2" id="utilizacionFlota"></div>

    </div>

    <div class="grid grid-cols-12 gap-1 m-2" style="border: 1px solid #ff4040">
        <div class="col-span-7 text-center"><p class="font-sans md:font-serif">Unidades en ruta</p></div>
        <div class="col-span-5 text-center"><p class="font-sans md:font-serif">Otras unidades</p></div>
        <div class="col-span-7 m-2 mt-0 flex justify-center items-center" id="informacionFlota"  style="border: 1px solid #000"></div>
        <div class="col-span-5 m-2 mt-0" id="otrasUnidades" style="border: 1px solid #000"></div>
                            


    </div>
</div>

<div class="footer bg-white">

<div class="grid grid-cols-12 m-0 text-xs">
    <div class="col-span-9 text-sm">
        <p class="font-sans md:font-serif text-left">
            Gráficos generados con la información recopilada a lo largo de la operación correspondiente.
            Dudas y comentarios con tu analista en turno.
        </p>
    </div>
    
    <div class="col-span-3 text-sm mr-2">
        <p class="text-right font-sans md:font-serif ">Fecha de operación: {{$fechaDMY}}</p>
    </div>

</div>
</div>

<!--habitos de conduccion-->

<div class="cuerpoHabitosConduccion border bg-white">
        <div class="grid grid-cols-12 mb-0">
            <div class="col-span-3 flex justify-center items-center m-2 ml-3 mb-0" style="height: 50px" ><img src="{{URL::asset('/images/logo-bachoco.png')}}" style="height: 30px;"></div>
    
    
            <div class="col-span-6 flex justify-center items-center text-3xl" style="height: 50px">
                <p class="font-sans md:font-serif" >
                    Hábitos de conducción @foreach($cedis as $cedi) {{$cedi->nb_cedis}}  @endforeach @foreach($operacion as $opera) {{$opera->nb_operacion}} @endforeach
                </p>
            </div>
            <div class="col-span-3 flex justify-center items-center mr-2 ml-0 text-sm" style="align-content: right">
                <p class="font-sans md:font-serif font-bold"><br>
                Torre de monitoreo T2&nbsp;
                </p>
                <img src="{{URL::asset('/images/torre-monitoreo.png')}}" style="height: 40px; ">
            </div>
    
        </div>
    
            <div class="m-2 mt-0" style="border: 1px solid #ff4040">
    
                        <div id="velocidadGraficoUno" style="border: 1px solid #000" class="m-2 flex justify-center items-center" ></div>
                        
    
            </div>
    
            <div class="grid grid-cols-12 gap-1 m-2 altoVelocidadDosTres" style="border: 1px solid #ff4040">
    
                <div id="velocidadGraficoDos" style="border: 1px solid #000" class="col-span-6 flex justify-center items-center m-2 mb-0" ></div>
    
                <div id="velocidadGraficoTres" style="border: 1px solid #000" class="col-span-6 flex justify-center items-center m-2 mb-0"></div>
                <div class="col-span-6 mt-0" >
                    <p class="font-sans md:font-serif text-center" >
                        EVS = Sobrepasar 60 km/h por mas de 1 min.
                    </p>
                </div>
                <div class="col-span-6 mt-0" >
                    <p class="font-sans md:font-serif text-center" >
                        EVS = Sobrepasar 100 km/h por mas de 1 min.
                    </p>
                </div>
    
                            
                 
            </div>
            
    
    </div>
    
    <div class="footer bg-white">
    
        <div class="grid grid-cols-12 m-0 text-xs">
            <div class="col-span-9 text-sm">
                <p class="font-sans md:font-serif text-left">
                    Gráficos generados con la información recopilada a lo largo de la operación correspondiente.
                    Dudas y comentarios con tu analista en turno.
                </p>
            </div>
            
            <div class="col-span-3 text-sm mr-2">
                <p class="text-right font-sans md:font-serif ">Fecha de operación: {{$fechaDMY}}</p>
            </div>
    
        </div>
    </div>

    <!--incidencias de ruta-->
<div class="cuerpoIncidenciasRuta border bg-white">
    <div class="grid grid-cols-12 mb-0">
        <div class="col-span-3 flex justify-center items-center m-2 mb-0" style="height: 50px" ><img src="{{URL::asset('/images/logo-bachoco.png')}}" style="height: 30px;"></div>


        <div class="col-span-6 flex justify-center items-center text-3xl" style="height: 50px">
            <p class="font-sans md:font-serif" >
                Incidencias de ruta @foreach($cedis as $cedi) {{$cedi->nb_cedis}}  @endforeach @foreach($operacion as $opera) {{$opera->nb_operacion}} @endforeach

            </p>
        </div>
        <div class="col-span-3 flex justify-center items-center mr-2 ml-0 text-sm" style="align-content: right">
            <p class="font-sans md:font-serif font-bold"><br>
            Torre de monitoreo T2&nbsp;
            </p>
            <img src="{{URL::asset('/images/torre-monitoreo.png')}}" style="height: 40px; ">
        </div>


    </div>
    <div class="grid grid-cols-12 gap-1 m-2 mt-0" style="border: 1px solid #ff4040">
        <div class="col-span-12 m-2 flex justify-center items-center" id="incidencias"  style="border: 1px solid #000"></div>
    </div>
    <div class="grid grid-cols-12 gap-1 m-2" style="border: 1px solid #ff4040">
        <div class="col-span-6 m-2" id="paradasAutorizadas" style="border: 1px solid #000"></div>
        <div class="col-span-6 flex justify-center items-center m-2" id="paradasNoAutorizadas" style="border: 1px solid #000"></div>
    </div>

</div>

<div class="footer bg-white">

    <div class="grid grid-cols-12 m-0 text-xs">
        <div class="col-span-9 text-sm">
            <p class="font-sans md:font-serif text-left">
                Gráficos generados con la información recopilada a lo largo de la operación correspondiente.
                Dudas y comentarios con tu analista en turno.
            </p>
        </div>
        
        <div class="col-span-3 text-sm mr-2">
            <p class="text-right font-sans md:font-serif ">Fecha de operación: {{$fechaDMY}}</p>
        </div>

    </div>
</div>



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

<script>

//generar disponibilidad
        $(document).ready(function(){
        //hacemos focus al campo de búsqueda

        var fecha = '{{$fecha}}';
        var id_operacion = '{{$id_operacion}}';
        var id_cedis = '{{$id_cedis}}';

        function generarDisponibilidadFlota(){          
            //hace la búsqueda
            $.ajax({ // create an AJAX call...
            data:  {
                "_token": $("meta[name='csrf-token']").attr("content"),
                fecha:fecha,
                id_operacion:id_operacion,
                id_cedis:id_cedis

            },

            type: "POST", // GET or POST
            url: "{{ route('reportes.disponibilidadFlota') }}", // the file to call
            dataType: 'html',   
            success: function(informacionFlota) {

            if (informacionFlota) {
                console.log(informacionFlota);

                $('#disponibilidad').html(informacionFlota);
                alert("¡Disponibilidad de flota lista!");

            } else {

                $("#id_cedis").empty();
            }
            }

            
            
        });
        }

        generarDisponibilidadFlota();

        });
</script>

<script>

    $(document).ready(function(){
    //hacemos focus al campo de búsqueda

    var fecha = '{{$fecha}}';
    var id_operacion = '{{$id_operacion}}';
    var id_cedis = '{{$id_cedis}}';

    function generarUtilizacionFlota(){          
        //hace la búsqueda
        $.ajax({ // create an AJAX call...
        data:  {
            "_token": $("meta[name='csrf-token']").attr("content"),
            id_operacion:id_operacion,
            fecha:fecha,
            id_cedis:id_cedis

        },

        type: "POST", // GET or POST
        url: "{{ route('reportes.utilizacionFlota') }}", // the file to call
        dataType: 'html',   
        success: function(utilizacionFlota) {

        if (utilizacionFlota) {
            console.log(utilizacionFlota);

            $('#utilizacionFlota').html(utilizacionFlota);
            alert("¡Utilización de flota listo!");



        } else {

            $("#utilizacionFLota").empty();
        }
        }



    });
    }
    generarUtilizacionFlota();

});


</script>


<script>


    //informacion de flota tabla de choferes
    $(document).ready(function(){
    //hacemos focus al campo de búsqueda

    var fecha = '{{$fecha}}';
    var id_operacion = '{{$id_operacion}}';
    var id_cedis = '{{$id_cedis}}';
    

    function generarInformacionFlota(){          
        //hace la búsqueda
        $.ajax({


    data: {
        "_token": $("meta[name='csrf-token']").attr("content"),
        id_operacion:id_operacion,
        fecha:fecha,
        id_cedis:id_cedis
    },
    type: "POST", // GET or POST
        url: "{{ route('reportes.informacionFlota') }}", // the file to call
        dataType: 'html',   
        success: function(informacionFlota) {

        if (informacionFlota) {
            console.log(informacionFlota);

            $('#informacionFlota').html(informacionFlota);
            alert("Información de flota lista!");



        } else {

            $("#informacionFLota").empty();
        }
        }



    });
    }

    generarInformacionFlota();

    });
</script>

<script>

//generar otras unidades
    $(document).ready(function(){
    //hacemos focus al campo de búsqueda

    var fecha = '{{$fecha}}';
    var id_operacion = '{{$id_operacion}}';
    var id_cedis = '{{$id_cedis}}';

    function generarOtrasUnidades(){          
        //hace la búsqueda
        $.ajax({ // create an AJAX call...
        data:  {
            "_token": $("meta[name='csrf-token']").attr("content"),
            id_operacion:id_operacion,
            fecha:fecha,
            id_cedis:id_cedis
        },

        type: "POST", // GET or POST
        url: "{{ route('reportes.otrasUnidades') }}", // the file to call
        dataType: 'html',   
        success: function(otrasUnidades) {

        if (otrasUnidades) {
            console.log(otrasUnidades);

            $('#otrasUnidades').html(otrasUnidades);
            alert("¡Otras unidades listas!");



        } else {

            $("#otrasUnidades").empty();
        }
        }



    });
    }

    generarOtrasUnidades();

    });

    </script>



<!--habitos de conduccion-->

<script>

//velocidades
$(document).ready(function(){
//hacemos focus al campo de búsqueda

    var fecha = '{{$fecha}}';
    var id_operacion = '{{$id_operacion}}';
    var id_cedis = '{{$id_cedis}}';

function generarGraficaVelocidades(){          
    //hace la búsqueda
    $.ajax({ // create an AJAX call...
    data:  {
        "_token": $("meta[name='csrf-token']").attr("content"),
        id_operacion:id_operacion,
        fecha:fecha,
        id_cedis:id_cedis

    },

    type: "POST", // GET or POST
    url: "{{ route('reportes.calcularExcesosVelocidad') }}", // the file to call
    dataType: 'html',   
    success: function(velocidades) {

    if (velocidades) {
        console.log(velocidades);

        $('#velocidadGraficoUno').html(velocidades);
        alert("¡Velocidades listas!");



    } else {

        $("#velocidadGraficoUno").empty();
    }
    }



});
}

generarGraficaVelocidades();

});

</script>

<script>


//velocidad local
            $(document).ready(function(){
                        //hacemos focus al campo de búsqueda
    
                        var fecha = '{{$fecha}}';
                        var id_operacion = '{{$id_operacion}}';
                        var id_cedis = '{{$id_cedis}}';
    
                        function generarGraficaVelocidadesLocales(){          
                            //hace la búsqueda
                            $.ajax({ // create an AJAX call...
                            data:  {
                                "_token": $("meta[name='csrf-token']").attr("content"),
                                id_operacion:id_operacion,
                                fecha:fecha,
                                id_cedis:id_cedis
    
                            },
    
                            type: "POST", // GET or POST
                            url: "{{ route('reportes.velocidadGraficoDos') }}", // the file to call
                            dataType: 'html',   
                            success: function(velocidades) {
    
                            if (velocidades) {
                                console.log(velocidades);
    
                                $('#velocidadGraficoDos').html(velocidades);
                                alert("¡Velocidad Foranea lista!");
    
    
    
                            } else {
    
                                $("#velocidadGraficoDos").empty();
                            }
                            }
    
    
    
                        });
                }
    
                generarGraficaVelocidadesLocales();
    
            });
</script>

<script>

//velocidad foranea
            $(document).ready(function(){
                        //hacemos focus al campo de búsqueda
    
                        var fecha = '{{$fecha}}';
                        var id_operacion = '{{$id_operacion}}';
                        var id_cedis = '{{$id_cedis}}';
    
                        function generarGraficaVelocidadesForanea(){          
                            //hace la búsqueda
                            $.ajax({ // create an AJAX call...
                            data:  {
                                "_token": $("meta[name='csrf-token']").attr("content"),
                                id_operacion:id_operacion,
                                fecha:fecha,
                                id_cedis:id_cedis
    
                            },
    
                            type: "POST", // GET or POST
                                url: "{{ route('reportes.velocidadGraficoTres') }}", // the file to call
                                dataType: 'html',   
                                success: function(velocidades) {
    
                                if (velocidades) {
                                    console.log(velocidades);
    
                                    $('#velocidadGraficoTres').html(velocidades);
                                    alert("¡Velocidad ruta foránea lista!");
    
    
    
                                } else {
    
                                    $("#velocidadGraficoTres").empty();
                                }
                                }
    
    
    
                            });
                }
    
                generarGraficaVelocidadesForanea();
    
            });
    </script>

        <!--incidencias de ruta-->
        <script>

//incidencias
$(document).ready(function(){
        //hacemos focus al campo de búsqueda

        var fecha = '{{$fecha}}';
        var id_operacion = '{{$id_operacion}}';
        var id_cedis = '{{$id_cedis}}';

        function generarGraficaIncidencias(){          
            //hace la búsqueda
            $.ajax({ // create an AJAX call...
            data:  {
                "_token": $("meta[name='csrf-token']").attr("content"),
                id_operacion:id_operacion,
                fecha:fecha,
                id_cedis:id_cedis

            },

            type: "POST", // GET or POST
            url: "{{ route('reportes.incidencias') }}", // the file to call
            dataType: 'html',   
            success: function(incidencias) {

            if (incidencias) {
                console.log(incidencias);

                $('#incidencias').html(incidencias);
                alert("¡Incidencias listas!");



            } else {

                $("#incidencias").empty();
            }
            }



        });
}

generarGraficaIncidencias();

});
</script>

<script>


//paradas autorizadas
                $(document).ready(function(){
                //hacemos focus al campo de búsqueda

                var fecha = '{{$fecha}}';
                var id_operacion = '{{$id_operacion}}';
                var id_cedis = '{{$id_cedis}}';

                function generarGraficaParadasAutorizadas(){          
                    //hace la búsqueda
                    $.ajax({ // create an AJAX call...
                    data:  {
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        id_operacion:id_operacion,
                        fecha:fecha,
                        id_cedis:id_cedis

                    },

                    type: "POST", // GET or POST
                    url: "{{ route('reportes.paradasAutorizadas') }}", // the file to call
                    dataType: 'html',   
                    success: function(paradasAutorizadas) {

                    if (paradasAutorizadas) {
                        console.log(paradasAutorizadas);

                        $('#paradasAutorizadas').html(paradasAutorizadas);
                        alert("¡Paradas autorizadas listas!");



                    } else {

                        $("#paradasAutorizadas").empty();
                    }
                    }



                });
        }

        generarGraficaParadasAutorizadas();

    });
</script>

<script>
//paradas no autorizadas
    $(document).ready(function(){
                //hacemos focus al campo de búsqueda

                var fecha = '{{$fecha}}';
                var id_operacion = '{{$id_operacion}}';
                var id_cedis = '{{$id_cedis}}';

                function generarGraficaNoParadasAutorizadas(){          
                    //hace la búsqueda
                    $.ajax({ // create an AJAX call...
                    data:  {
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        id_operacion:id_operacion,
                        fecha:fecha,
                        id_cedis:id_cedis

                    },

                    type: "POST", // GET or POST
                    url: "{{ route('reportes.paradasNoAutorizadas') }}", // the file to call
                    dataType: 'html',   
                    success: function(paradasNoAutorizadas) {

                    if (paradasNoAutorizadas) {
                        console.log(paradasNoAutorizadas);

                        $('#paradasNoAutorizadas').html(paradasNoAutorizadas);
                        alert("¡Paradas no autorizadas listas!");



                    } else {

                        $("#paradasNoAutorizadas").empty();
                    }
                    }



                });
        }

        generarGraficaNoParadasAutorizadas();

    });


    </script>
