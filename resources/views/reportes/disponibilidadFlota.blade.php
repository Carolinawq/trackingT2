    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
    

            ['Task', 'Hours per Day'],
            [ 'DISPONIBLES',  {{$disponibles}}],
            [ 'NO DISPONIBLES',  {{$noDisponibles}}],



          ]);
  
          var options = {
            title: 'Disponibilidad de la flota',
            fontSize: 14,
            bold: true,
            is3D: true,
            
            legend: { position: 'bottom',
                      maxLines: 3,
                      textStyle: {
                      fontSize: 10,
                      bold: true,


                    }
            },
            annotations: {
                    alwaysOutside: false,
                    highContrast: true,  // default is true, but be sure
                    
                    textStyle: {
                      bold: true,

                    }
                  },
            chartArea: {
                  'width': '85%',
                  'height': '80%'

              //right: 100, // set this to adjust the legend width
              //left: 60, // set this to adjust the left margin
            },
            

            

            slices: {
            0: { color: '#87cefa' },
            1: { color: 'orange' },
            2: { color: 'green' },
            3: { color: 'purple' },
            4: { color: 'red' },
            5: { color: 'brown' },
            6: { color: 'pink' },
            7: { color: 'gray' },
            
            }
          };
  
          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
          chart.draw(data, options);
        }
      </script>
        <div id="piechart_3d" style="width: 470px; height: 430px;">
          <label class="font-bold mb-1 text-gray-700 block">
            <span class="text-gray-700">Disponibilidad de flota</span>
          </label>
          
        </div>




