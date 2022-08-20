  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "{{$choferMasExcesos.' '.$unidadMasExcesos}}", { role: "style" } ],
        
        @foreach($consultaRepeticionVelocidadLocalChofer as $row)
        ["{{$row->total}}", {{$row->velocidad}}, "#2271b3"],
        @endforeach
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "EXCESOS DE VELOCIDAD SOSTENIDA EN RUTA LOCAL (KM/HR).",
        titleTextStyle: {
        color: '#2271b3',
        fontSize: 14,
        maxLines: 3,

        },
        width: 570,
        height: 315,
        bar: {groupWidth: "80%"},
        legend: { position: "bottom", textStyle: {fontSize: 13}},
        
        hAxis: {
                textStyle: {
                color: 'black',
                fontName: 'Arial Black',
                fontSize: 12,
                bold:true
              },
    
            },

        chartArea: {
                'width': '85%',
                'height': '80%'
        },
          

        annotations: {
                    alwaysOutside: true,
                    highContrast: true,  // default is true, but be sure
                    textStyle: {
                      bold: true,
                      fontSize: 18,

                    }
                  },
            colors: [
                    '#2271b3', 
                    ],

            plotOptions: {
                column: {
                    colorByPoint: true
                }
},
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("graficosDos"));
      chart.draw(view, options);
  }
  </script>
<div id="graficosDos">

</div>



