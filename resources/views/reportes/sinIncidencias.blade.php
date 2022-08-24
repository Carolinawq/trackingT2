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
  data.addColumn('number', 'Parada autorizada');
  data.addColumn('number', 'Parada no autorizada');
  data.addColumn({type: 'string', role: 'annotation'});

  data.addRows([
          ['0', 0, 0, '0'],
  ]);

  // Set chart options
  var options = {
    isStacked: true,

    
    
   };
  var options = {
    legend: {
      position: 'right',
      textStyle: {fontSize: 11}
    },

    title: "INCIDENCIAS.",
        titleTextStyle: {
        color: '#000',
        fontSize: 11,
        maxLines: 3,
         },
    width: 1117,
    height: 408,

    chartArea: {
      right: 150, // set this to adjust the legend width
      left: 60, // set this to adjust the left margin
    },

   

    annotations: {
                    alwaysOutside: true,
                    highContrast: true,  // default is true, but be sure
                    textStyle: {
                      bold: true,
                      fontSize: 18,
                      color: 'black',

                      

                    }
                  },
  

    

    isStacked: true,
    colors: [
      '#90ee90',
      '#ff4500'
    ]
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('incidencias'));
  chart.draw(data, options);
}
</script>
<div id='incidencias'></div>
