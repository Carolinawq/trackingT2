<script src="{{ asset('js/loader.js') }}"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Unidad');
        data.addColumn('string', 'Vuelta');
        data.addColumn('string', 'Chofer');
        data.addColumn('string', 'Ruta');


        data.addRows([
          @foreach ($choferes as $row)

          ['{{$row->nb_unidad}}', '{{$row->no_vuelta}}', '{{$row->nb_chofer.' '.$row->nb_chofer_a_paterno}}', '{{$row->nb_ruta}}'],
          @endforeach

        ]);


        var table = new google.visualization.Table(document.getElementById('table_div'));

        


        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
    <div id="table_div" style="width: 670px; "></div>

