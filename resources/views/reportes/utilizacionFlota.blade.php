<script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Utilización de flota', @foreach($estatusUnidades as $row) '{{$row->nb_estatus}}' , { role: 'annotation' } , @endforeach ],



        ['{{$fechaDMY}}', @foreach($estatusUnidades as $row) {{$row->total}}, '{{$row->total}}', @endforeach  ],  ]);

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
                      fontSize: 18,
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
        isStacked: false,

        annotations: {
        
                alwaysOutside: true,
                highContrast: true,  // default is true, but be sure
                textStyle: {
                    bold: true,
                    fontSize: 18,

                }
            },
            colors: [

              @foreach($estatusUnidades as $row)
                    @if($row->nb_estatus == "Ruta")
                    '#87cefa',
                    @endif
                    @if($row->nb_estatus == "Taller")
                    '#ffa500',
                    @endif
                    @if($row->nb_estatus == "SINIESTRADO")
                    '#87cefa',
                    @endif
                    @if($row->nb_estatus == "Baja demanda")
                    '#ffa500',
                    @endif
              @endforeach
                    



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