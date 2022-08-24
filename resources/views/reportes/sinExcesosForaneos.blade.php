<!--
<img src = "{{ asset('/images/sin-excesos-foraneo.png') }} " style="width: 600px; height: 200px;" />-->
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "", { role: "style" } ],
        ["", 0, "#c71585"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "EXCESOS DE VELOCIDAD SOSTENIDA EN RUTA FORÁNEA (KM/HR)",
        titleTextStyle: {
        color: '#c71585',
        fontSize: 14,

        },
        width: 570,
        height: 315,
        bar: {groupWidth: "50%"},
        legend: { position: "bottom", textStyle: {fontSize: 13} },
        hAxis: {
                textStyle: {
                color: 'black',
                fontName: 'Arial Black',
                fontSize: 11,
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
      '#c71585',
      '#6582ba'
    ],
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("graficosTres"));
      chart.draw(view, options);
  }
  </script>
<div id="graficosTres"></div>



