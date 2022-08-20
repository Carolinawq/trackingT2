<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([




        ["Parada", "Total", { role: "style" } ],


        @foreach ($paradasAutorizadas as $row)

        ["{{$row->nb_motivo_parada}}", {{$row->total}}, ""],

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
        title: "MOTIVOS DE PARADA AUTORIZADA",
        titleTextStyle: {
        color: '#000',
        fontSize: 14,

        },

        hAxis: {
                textStyle: {
                color: 'black',
                fontName: 'Arial',
                fontSize: 12,
                bold:true
              },
    
            },



        width: 560,
        height: 345,

        chartArea: {
          'width': '80%',
          'height': '80%'

          //right: 100, // set this to adjust the legend width
          //left: 60, // set this to adjust the left margin
        },

        bar: {groupWidth: "50%"},
        legend: { position: "none" },

        annotations: {
                alwaysOutside: true,
                highContrast: true,  // default is true, but be sure
                textStyle: {
                    bold: true,
                    fontSize: 20,

                }
            },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("paradasAutorizadas"));
      chart.draw(view, options);
  }
  </script>


<div id="paradasAutorizadas">
  

</div>