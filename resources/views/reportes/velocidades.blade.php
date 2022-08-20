<script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  
  function drawChart() {
  /*var data = google.visualization.arrayToDataTable([
  		['SERIES', 'Cargado', 'No cargado', 'Presupuesto'],
  		['Afiliaciones', 100, 9, null],
  		['Presupuesto', null, null, 417]
  	  ]);*/

  var data = new google.visualization.DataTable();
  data.addColumn('string', 'RUTA');
  data.addColumn('number', 'Local');
  data.addColumn('number', 'Foraneo');
  data.addColumn({type: 'string', role: 'annotation'});

  data.addRows([
    @foreach ($consultaRepeticionLocalChofer as $row)
          ['{{$row->nb_chofer.'\n'.$row->nb_unidad}}', {{$row->total}}, 0, '{{$row->total}}'],
    @endforeach
    @foreach ($consultaRepeticionForaneaChofer as $row)
          ['{{$row->nb_chofer.'\n'.$row->nb_unidad}}', 0, {{$row->total}}, '{{$row->total}}'],
    @endforeach
  ]);

  // Set chart options
  var options = {
    isStacked: true,

    
    
   };
  var options = {
    legend: {
      position: 'right',
      textStyle: {fontSize: 12}
    },

    title: "EXCESOS DE VELOCIDAD (KM/HR).",
        titleTextStyle: {
        color: '#000',
        fontSize: 16,
        maxLines: 3,
         },
    width: 1170,
    height: 408,

    chartArea: {
      right: 100, // set this to adjust the legend width
      left: 60, // set this to adjust the left margin
    },
    

   

    annotations: {
                    alwaysOutside: false,
                    highContrast: true,  // default is true, but be sure
                    textStyle: {
                      bold: true,
                      fontSize: 18,
                      color: 'black'

                    }
                  },
  

    

    isStacked: true,
    colors: [
      '#2271b3',
      '#c71585',
      '#6582ba'
    ]
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('ch'));
  chart.draw(data, options);
}
</script>
<div id="ch"></div>