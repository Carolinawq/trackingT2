<script src="{{ asset('js/loader.js') }}"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Unidad');
        data.addColumn('string', 'Estatus');
        data.addColumn('string', 'Fecha');
        data.addColumn('string', 'Dias transcurridos');
        data.addRows([
          @foreach($otrasUnidades as $row)

          ['{{$row->nb_unidad}}','{{$row->nb_estatus}}','{{$row->fecha_ruta}}', '0'],
          @endforeach

        ]);

        var table = new google.visualization.Table(document.getElementById('otras_unidades'));

        


        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
    <div id="otras_unidades"></div>