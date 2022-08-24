<script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Utilización de flota', 'Ruta' , { role: 'annotation' }, 'Baja demanda' , { role: 'annotation' }, 'Prestamo' , { role: 'annotation' },'Descompostura' , { role: 'annotation' }, 'Taller' , { role: 'annotation' }, 'Corralon' , { role: 'annotation' },'Baja' , { role: 'annotation' },  ],
      @isset($lunes)
      ['{{$lunesDMY}}'
      ,{{$total_ruta_lunes}},@if($total_ruta_lunes == 0) '' @else'{{$total_ruta_lunes}}' @endif
      ,{{$total_baja_demanda_lunes}},@if($total_baja_demanda_lunes == 0) '' @else'{{$total_baja_demanda_lunes}}' @endif
      ,{{$total_prestamo_lunes}},@if($total_prestamo_lunes == 0) '' @else'{{$total_prestamo_lunes}}' @endif
      ,{{$total_descompostura_lunes}},@if($total_descompostura_lunes == 0) '' @else'{{$total_descompostura_lunes}}' @endif
      ,{{$total_taller_lunes}}, @if($total_taller_lunes == 0) '' @else'{{$total_taller_lunes}}' @endif
      ,{{$total_corralon_lunes}}, @if($total_corralon_lunes == 0) '' @else'{{$total_corralon_lunes}}' @endif
      ,{{$total_baja_lunes}}, @if($total_baja_lunes == 0) '' @else'{{$total_baja_lunes}}' @endif
      ,
      ]]);
      @endisset

      @isset($martes)
      ['{{$lunesDMY}}'
      ,{{$total_ruta_lunes}},@if($total_ruta_lunes == 0) '' @else'{{$total_ruta_lunes}}' @endif
      ,{{$total_baja_demanda_lunes}},@if($total_baja_demanda_lunes == 0) '' @else'{{$total_baja_demanda_lunes}}' @endif
      ,{{$total_prestamo_lunes}},@if($total_prestamo_lunes == 0) '' @else'{{$total_prestamo_lunes}}' @endif
      ,{{$total_descompostura_lunes}},@if($total_descompostura_lunes == 0) '' @else'{{$total_descompostura_lunes}}' @endif
      ,{{$total_taller_lunes}}, @if($total_taller_lunes == 0) '' @else'{{$total_taller_lunes}}' @endif
      ,{{$total_corralon_lunes}}, @if($total_corralon_lunes == 0) '' @else'{{$total_corralon_lunes}}' @endif
      ,{{$total_baja_lunes}}, @if($total_baja_lunes == 0) '' @else'{{$total_baja_lunes}}' @endif
      ,
      ],
      
      ['{{$martesDMY}}'
      ,{{$total_ruta_martes}},@if($total_ruta_martes == 0) '' @else'{{$total_ruta_martes}}' @endif
      ,{{$total_baja_demanda_martes}},@if($total_baja_demanda_martes == 0) '' @else'{{$total_baja_demanda_martes}}' @endif
      ,{{$total_prestamo_martes}},@if($total_prestamo_martes == 0) '' @else'{{$total_prestamo_martes}}' @endif
      ,{{$total_descompostura_martes}},@if($total_descompostura_martes == 0) '' @else'{{$total_descompostura_martes}}' @endif
      ,{{$total_taller_martes}}, @if($total_taller_martes == 0) '' @else'{{$total_taller_martes}}' @endif
      ,{{$total_corralon_martes}}, @if($total_corralon_martes == 0) '' @else'{{$total_corralon_martes}}' @endif
      ,{{$total_baja_martes}}, @if($total_baja_martes == 0) '' @else'{{$total_baja_martes}}' @endif
      ,
      ],
    ]);
      @endisset


    var view = new google.visualization.DataView(data);
    

        var options = {
        title: 'Utilización de flota',
        titleTextStyle: {
        color: '#000',
        fontSize: 14,
        bold: true,

        },

        
        hAxis: {
                textStyle: {
                color: 'black',
                fontName: 'Arial Black',
                fontSize: 14,
                bold:true
              },
    
            },
        
            legend: { position: 'bottom',
                      maxLines: 3,
                      textStyle: {
                      fontSize: 14,
                      bold: false,

                    }
            },

        width: 670,
        height: 430,

        chartArea: {
          'width': '85%',
          'height': '80%'

          //right: 100, // set this to adjust the legend width
          //left: 60, // set this to adjust the left margin
        },

        bar: { groupWidth: '75%' },
        isStacked: true,

        annotations: {
        
                alwaysOutside: false,
                highContrast: true,  // default is true, but be sure
                textStyle: {
                    bold: true,
                    fontSize: 18,

                }
            },
            colors: [

                    '#87cefa',
                    '#ffa500',
                    '#87cefa',
                    '#ffa500',
                    



                    ],

            plotOptions: {
                column: {
                    colorByPoint: true
                }
},
      };




      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values_uno"));
      chart.draw(view, options);
}
</script>
<div id="columnchart_values_uno" style="border: 1px solid #000"></div>