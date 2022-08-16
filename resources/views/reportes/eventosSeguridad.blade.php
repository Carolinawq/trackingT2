<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>


<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([




        ["Evento", "Repetición", { role: "style" } ],

        @foreach ($agruparEventos as $row)
        ["{{$row->nb_evento}}", {{$row->total}}, "#ttt"],
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

        fontSize: 14,

        width: 670,
        height: 380,

        chartArea: {
          'width': '85%',
          'height': '80%'

          //right: 100, // set this to adjust the legend width
          //left: 60, // set this to adjust the left margin
        },


        bar: {groupWidth: "60%"},
        legend: { position: "none" },

        annotations: {
                    alwaysOutside: true,
                    highContrast: true,  // default is true, but be sure
                    textStyle: {
                      bold: true,
                      fontSize: 18,

                      

                    }
                  },
      };


      
      var chart = new google.visualization.ColumnChart(document.getElementById("eventos"));
      chart.draw(view, options);
  }
  </script>


<div id="eventos">
  

</div>