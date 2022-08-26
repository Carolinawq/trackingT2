<script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Utilización de flota', 'Ruta' , { role: 'annotation' }, 'Baja demanda' , { role: 'annotation' }, 'Prestamo' , { role: 'annotation' },'Descompostura' , { role: 'annotation' }, 'Taller' , { role: 'annotation' }, 'Corralon' , { role: 'annotation' },'Baja' , { role: 'annotation' },  ],
      @isset($lunes)
      ['{{$lunesDMY}}'
      ,{{$total_ruta_lunes}},@if($total_ruta_lunes == 0) '' @else'{{$total_ruta_lunes}}' @endif
      ,{{$total_baja_demanda_lunes}},@if($total_baja_demanda_lunes == 0) '' @else'{{$total_baja_demanda_lunes}}' @endif
      ,{{$total_prestamo_lunes}},@if($total_prestamo_lunes == 0) '' @else'{{$total_prestamo_lunes}}' @endif
      ,{{$total_descompostura_lunes}},@if($total_descompostura_lunes == 0) '' @else'{{$total_descompostura_lunes}}' @endif
      ,{{$total_taller_lunes}}, @if($total_taller_lunes == 0) '' @else'{{$total_taller_lunes}}' @endif
      ,{{$total_corralon_lunes}}, @if($total_corralon_lunes == 0) '' @else'{{$total_corralon_lunes}}' @endif
      ,{{$total_baja_lunes}}, @if($total_baja_lunes == 0) '' @else'{{$total_baja_lunes}}' @endif
      ,
      ]]);
      @endisset

      @isset($martes)
      ['{{$lunesDMY}}'
      ,{{$total_ruta_lunes}},@if($total_ruta_lunes == 0) '' @else'{{$total_ruta_lunes}}' @endif
      ,{{$total_baja_demanda_lunes}},@if($total_baja_demanda_lunes == 0) '' @else'{{$total_baja_demanda_lunes}}' @endif
      ,{{$total_prestamo_lunes}},@if($total_prestamo_lunes == 0) '' @else'{{$total_prestamo_lunes}}' @endif
      ,{{$total_descompostura_lunes}},@if($total_descompostura_lunes == 0) '' @else'{{$total_descompostura_lunes}}' @endif
      ,{{$total_taller_lunes}}, @if($total_taller_lunes == 0) '' @else'{{$total_taller_lunes}}' @endif
      ,{{$total_corralon_lunes}}, @if($total_corralon_lunes == 0) '' @else'{{$total_corralon_lunes}}' @endif
      ,{{$total_baja_lunes}}, @if($total_baja_lunes == 0) '' @else'{{$total_baja_lunes}}' @endif
      ,
      ],
      
      ['{{$martesDMY}}'
      ,{{$total_ruta_martes}},@if($total_ruta_martes == 0) '' @else'{{$total_ruta_martes}}' @endif
      ,{{$total_baja_demanda_martes}},@if($total_baja_demanda_martes == 0) '' @else'{{$total_baja_demanda_martes}}' @endif
      ,{{$total_prestamo_martes}},@if($total_prestamo_martes == 0) '' @else'{{$total_prestamo_martes}}' @endif
      ,{{$total_descompostura_martes}},@if($total_descompostura_martes == 0) '' @else'{{$total_descompostura_martes}}' @endif
      ,{{$total_taller_martes}}, @if($total_taller_martes == 0) '' @else'{{$total_taller_martes}}' @endif
      ,{{$total_corralon_martes}}, @if($total_corralon_martes == 0) '' @else'{{$total_corralon_martes}}' @endif
      ,{{$total_baja_martes}}, @if($total_baja_martes == 0) '' @else'{{$total_baja_martes}}' @endif
      ,
      ],
    ]);
      @endisset

      @isset($miercoles)
      ['{{$lunesDMY}}'
      ,{{$total_ruta_lunes}},@if($total_ruta_lunes == 0) '' @else'{{$total_ruta_lunes}}' @endif
      ,{{$total_baja_demanda_lunes}},@if($total_baja_demanda_lunes == 0) '' @else'{{$total_baja_demanda_lunes}}' @endif
      ,{{$total_prestamo_lunes}},@if($total_prestamo_lunes == 0) '' @else'{{$total_prestamo_lunes}}' @endif
      ,{{$total_descompostura_lunes}},@if($total_descompostura_lunes == 0) '' @else'{{$total_descompostura_lunes}}' @endif
      ,{{$total_taller_lunes}}, @if($total_taller_lunes == 0) '' @else'{{$total_taller_lunes}}' @endif
      ,{{$total_corralon_lunes}}, @if($total_corralon_lunes == 0) '' @else'{{$total_corralon_lunes}}' @endif
      ,{{$total_baja_lunes}}, @if($total_baja_lunes == 0) '' @else'{{$total_baja_lunes}}' @endif
      ,
      ],
      
      ['{{$martesDMY}}'
      ,{{$total_ruta_martes}},@if($total_ruta_martes == 0) '' @else'{{$total_ruta_martes}}' @endif
      ,{{$total_baja_demanda_martes}},@if($total_baja_demanda_martes == 0) '' @else'{{$total_baja_demanda_martes}}' @endif
      ,{{$total_prestamo_martes}},@if($total_prestamo_martes == 0) '' @else'{{$total_prestamo_martes}}' @endif
      ,{{$total_descompostura_martes}},@if($total_descompostura_martes == 0) '' @else'{{$total_descompostura_martes}}' @endif
      ,{{$total_taller_martes}}, @if($total_taller_martes == 0) '' @else'{{$total_taller_martes}}' @endif
      ,{{$total_corralon_martes}}, @if($total_corralon_martes == 0) '' @else'{{$total_corralon_martes}}' @endif
      ,{{$total_baja_martes}}, @if($total_baja_martes == 0) '' @else'{{$total_baja_martes}}' @endif
      ,
      ],
      ['{{$miercolesDMY}}'
      ,{{$total_ruta_miercoles}},@if($total_ruta_miercoles == 0) '' @else'{{$total_ruta_miercoles}}' @endif
      ,{{$total_baja_demanda_miercoles}},@if($total_baja_demanda_miercoles == 0) '' @else'{{$total_baja_demanda_miercoles}}' @endif
      ,{{$total_prestamo_miercoles}},@if($total_prestamo_miercoles == 0) '' @else'{{$total_prestamo_miercoles}}' @endif
      ,{{$total_descompostura_miercoles}},@if($total_descompostura_miercoles == 0) '' @else'{{$total_descompostura_miercoles}}' @endif
      ,{{$total_taller_miercoles}}, @if($total_taller_miercoles == 0) '' @else'{{$total_taller_miercoles}}' @endif
      ,{{$total_corralon_miercoles}}, @if($total_corralon_miercoles == 0) '' @else'{{$total_corralon_miercoles}}' @endif
      ,{{$total_baja_miercoles}}, @if($total_baja_miercoles == 0) '' @else'{{$total_baja_miercoles}}' @endif
      ,
      ],
    ]);
      @endisset

      @isset($jueves)
      ['{{$lunesDMY}}'
      ,{{$total_ruta_lunes}},@if($total_ruta_lunes == 0) '' @else'{{$total_ruta_lunes}}' @endif
      ,{{$total_baja_demanda_lunes}},@if($total_baja_demanda_lunes == 0) '' @else'{{$total_baja_demanda_lunes}}' @endif
      ,{{$total_prestamo_lunes}},@if($total_prestamo_lunes == 0) '' @else'{{$total_prestamo_lunes}}' @endif
      ,{{$total_descompostura_lunes}},@if($total_descompostura_lunes == 0) '' @else'{{$total_descompostura_lunes}}' @endif
      ,{{$total_taller_lunes}}, @if($total_taller_lunes == 0) '' @else'{{$total_taller_lunes}}' @endif
      ,{{$total_corralon_lunes}}, @if($total_corralon_lunes == 0) '' @else'{{$total_corralon_lunes}}' @endif
      ,{{$total_baja_lunes}}, @if($total_baja_lunes == 0) '' @else'{{$total_baja_lunes}}' @endif
      ,
      ],
      
      ['{{$martesDMY}}'
      ,{{$total_ruta_martes}},@if($total_ruta_martes == 0) '' @else'{{$total_ruta_martes}}' @endif
      ,{{$total_baja_demanda_martes}},@if($total_baja_demanda_martes == 0) '' @else'{{$total_baja_demanda_martes}}' @endif
      ,{{$total_prestamo_martes}},@if($total_prestamo_martes == 0) '' @else'{{$total_prestamo_martes}}' @endif
      ,{{$total_descompostura_martes}},@if($total_descompostura_martes == 0) '' @else'{{$total_descompostura_martes}}' @endif
      ,{{$total_taller_martes}}, @if($total_taller_martes == 0) '' @else'{{$total_taller_martes}}' @endif
      ,{{$total_corralon_martes}}, @if($total_corralon_martes == 0) '' @else'{{$total_corralon_martes}}' @endif
      ,{{$total_baja_martes}}, @if($total_baja_martes == 0) '' @else'{{$total_baja_martes}}' @endif
      ,
      ],
      ['{{$miercolesDMY}}'
      ,{{$total_ruta_miercoles}},@if($total_ruta_miercoles == 0) '' @else'{{$total_ruta_miercoles}}' @endif
      ,{{$total_baja_demanda_miercoles}},@if($total_baja_demanda_miercoles == 0) '' @else'{{$total_baja_demanda_miercoles}}' @endif
      ,{{$total_prestamo_miercoles}},@if($total_prestamo_miercoles == 0) '' @else'{{$total_prestamo_miercoles}}' @endif
      ,{{$total_descompostura_miercoles}},@if($total_descompostura_miercoles == 0) '' @else'{{$total_descompostura_miercoles}}' @endif
      ,{{$total_taller_miercoles}}, @if($total_taller_miercoles == 0) '' @else'{{$total_taller_miercoles}}' @endif
      ,{{$total_corralon_miercoles}}, @if($total_corralon_miercoles == 0) '' @else'{{$total_corralon_miercoles}}' @endif
      ,{{$total_baja_miercoles}}, @if($total_baja_miercoles == 0) '' @else'{{$total_baja_miercoles}}' @endif
      ,
      ],
      ['{{$juevesDMY}}'
      ,{{$total_ruta_jueves}},@if($total_ruta_jueves == 0) '' @else'{{$total_ruta_jueves}}' @endif
      ,{{$total_baja_demanda_jueves}},@if($total_baja_demanda_jueves == 0) '' @else'{{$total_baja_demanda_jueves}}' @endif
      ,{{$total_prestamo_jueves}},@if($total_prestamo_jueves == 0) '' @else'{{$total_prestamo_jueves}}' @endif
      ,{{$total_descompostura_jueves}},@if($total_descompostura_jueves == 0) '' @else'{{$total_descompostura_jueves}}' @endif
      ,{{$total_taller_jueves}}, @if($total_taller_jueves == 0) '' @else'{{$total_taller_jueves}}' @endif
      ,{{$total_corralon_jueves}}, @if($total_corralon_jueves == 0) '' @else'{{$total_corralon_jueves}}' @endif
      ,{{$total_baja_jueves}}, @if($total_baja_jueves == 0) '' @else'{{$total_baja_jueves}}' @endif
      ,
      ],
    ]);
      @endisset
      @isset($viernes)
      ['{{$lunesDMY}}'
      ,{{$total_ruta_lunes}},@if($total_ruta_lunes == 0) '' @else'{{$total_ruta_lunes}}' @endif
      ,{{$total_baja_demanda_lunes}},@if($total_baja_demanda_lunes == 0) '' @else'{{$total_baja_demanda_lunes}}' @endif
      ,{{$total_prestamo_lunes}},@if($total_prestamo_lunes == 0) '' @else'{{$total_prestamo_lunes}}' @endif
      ,{{$total_descompostura_lunes}},@if($total_descompostura_lunes == 0) '' @else'{{$total_descompostura_lunes}}' @endif
      ,{{$total_taller_lunes}}, @if($total_taller_lunes == 0) '' @else'{{$total_taller_lunes}}' @endif
      ,{{$total_corralon_lunes}}, @if($total_corralon_lunes == 0) '' @else'{{$total_corralon_lunes}}' @endif
      ,{{$total_baja_lunes}}, @if($total_baja_lunes == 0) '' @else'{{$total_baja_lunes}}' @endif
      ,
      ],
      
      ['{{$martesDMY}}'
      ,{{$total_ruta_martes}},@if($total_ruta_martes == 0) '' @else'{{$total_ruta_martes}}' @endif
      ,{{$total_baja_demanda_martes}},@if($total_baja_demanda_martes == 0) '' @else'{{$total_baja_demanda_martes}}' @endif
      ,{{$total_prestamo_martes}},@if($total_prestamo_martes == 0) '' @else'{{$total_prestamo_martes}}' @endif
      ,{{$total_descompostura_martes}},@if($total_descompostura_martes == 0) '' @else'{{$total_descompostura_martes}}' @endif
      ,{{$total_taller_martes}}, @if($total_taller_martes == 0) '' @else'{{$total_taller_martes}}' @endif
      ,{{$total_corralon_martes}}, @if($total_corralon_martes == 0) '' @else'{{$total_corralon_martes}}' @endif
      ,{{$total_baja_martes}}, @if($total_baja_martes == 0) '' @else'{{$total_baja_martes}}' @endif
      ,
      ],
      ['{{$miercolesDMY}}'
      ,{{$total_ruta_miercoles}},@if($total_ruta_miercoles == 0) '' @else'{{$total_ruta_miercoles}}' @endif
      ,{{$total_baja_demanda_miercoles}},@if($total_baja_demanda_miercoles == 0) '' @else'{{$total_baja_demanda_miercoles}}' @endif
      ,{{$total_prestamo_miercoles}},@if($total_prestamo_miercoles == 0) '' @else'{{$total_prestamo_miercoles}}' @endif
      ,{{$total_descompostura_miercoles}},@if($total_descompostura_miercoles == 0) '' @else'{{$total_descompostura_miercoles}}' @endif
      ,{{$total_taller_miercoles}}, @if($total_taller_miercoles == 0) '' @else'{{$total_taller_miercoles}}' @endif
      ,{{$total_corralon_miercoles}}, @if($total_corralon_miercoles == 0) '' @else'{{$total_corralon_miercoles}}' @endif
      ,{{$total_baja_miercoles}}, @if($total_baja_miercoles == 0) '' @else'{{$total_baja_miercoles}}' @endif
      ,
      ],
      ['{{$juevesDMY}}'
      ,{{$total_ruta_jueves}},@if($total_ruta_jueves == 0) '' @else'{{$total_ruta_jueves}}' @endif
      ,{{$total_baja_demanda_jueves}},@if($total_baja_demanda_jueves == 0) '' @else'{{$total_baja_demanda_jueves}}' @endif
      ,{{$total_prestamo_jueves}},@if($total_prestamo_jueves == 0) '' @else'{{$total_prestamo_jueves}}' @endif
      ,{{$total_descompostura_jueves}},@if($total_descompostura_jueves == 0) '' @else'{{$total_descompostura_jueves}}' @endif
      ,{{$total_taller_jueves}}, @if($total_taller_jueves == 0) '' @else'{{$total_taller_jueves}}' @endif
      ,{{$total_corralon_jueves}}, @if($total_corralon_jueves == 0) '' @else'{{$total_corralon_jueves}}' @endif
      ,{{$total_baja_jueves}}, @if($total_baja_jueves == 0) '' @else'{{$total_baja_jueves}}' @endif
      ,
      ],
      ['{{$viernesDMY}}'
      ,{{$total_ruta_viernes}},@if($total_ruta_viernes == 0) '' @else'{{$total_ruta_viernes}}' @endif
      ,{{$total_baja_demanda_viernes}},@if($total_baja_demanda_viernes == 0) '' @else'{{$total_baja_demanda_viernes}}' @endif
      ,{{$total_prestamo_viernes}},@if($total_prestamo_viernes == 0) '' @else'{{$total_prestamo_viernes}}' @endif
      ,{{$total_descompostura_viernes}},@if($total_descompostura_viernes == 0) '' @else'{{$total_descompostura_viernes}}' @endif
      ,{{$total_taller_viernes}}, @if($total_taller_viernes == 0) '' @else'{{$total_taller_viernes}}' @endif
      ,{{$total_corralon_viernes}}, @if($total_corralon_viernes == 0) '' @else'{{$total_corralon_viernes}}' @endif
      ,{{$total_baja_viernes}}, @if($total_baja_viernes == 0) '' @else'{{$total_baja_viernes}}' @endif
      ,
      ],
    ]);
      @endisset

      @isset($sabado)
      ['{{$lunesDMY}}'
      ,{{$total_ruta_lunes}},@if($total_ruta_lunes == 0) '' @else'{{$total_ruta_lunes}}' @endif
      ,{{$total_baja_demanda_lunes}},@if($total_baja_demanda_lunes == 0) '' @else'{{$total_baja_demanda_lunes}}' @endif
      ,{{$total_prestamo_lunes}},@if($total_prestamo_lunes == 0) '' @else'{{$total_prestamo_lunes}}' @endif
      ,{{$total_descompostura_lunes}},@if($total_descompostura_lunes == 0) '' @else'{{$total_descompostura_lunes}}' @endif
      ,{{$total_taller_lunes}}, @if($total_taller_lunes == 0) '' @else'{{$total_taller_lunes}}' @endif
      ,{{$total_corralon_lunes}}, @if($total_corralon_lunes == 0) '' @else'{{$total_corralon_lunes}}' @endif
      ,{{$total_baja_lunes}}, @if($total_baja_lunes == 0) '' @else'{{$total_baja_lunes}}' @endif
      ,
      ],
      
      ['{{$martesDMY}}'
      ,{{$total_ruta_martes}},@if($total_ruta_martes == 0) '' @else'{{$total_ruta_martes}}' @endif
      ,{{$total_baja_demanda_martes}},@if($total_baja_demanda_martes == 0) '' @else'{{$total_baja_demanda_martes}}' @endif
      ,{{$total_prestamo_martes}},@if($total_prestamo_martes == 0) '' @else'{{$total_prestamo_martes}}' @endif
      ,{{$total_descompostura_martes}},@if($total_descompostura_martes == 0) '' @else'{{$total_descompostura_martes}}' @endif
      ,{{$total_taller_martes}}, @if($total_taller_martes == 0) '' @else'{{$total_taller_martes}}' @endif
      ,{{$total_corralon_martes}}, @if($total_corralon_martes == 0) '' @else'{{$total_corralon_martes}}' @endif
      ,{{$total_baja_martes}}, @if($total_baja_martes == 0) '' @else'{{$total_baja_martes}}' @endif
      ,
      ],
      ['{{$miercolesDMY}}'
      ,{{$total_ruta_miercoles}},@if($total_ruta_miercoles == 0) '' @else'{{$total_ruta_miercoles}}' @endif
      ,{{$total_baja_demanda_miercoles}},@if($total_baja_demanda_miercoles == 0) '' @else'{{$total_baja_demanda_miercoles}}' @endif
      ,{{$total_prestamo_miercoles}},@if($total_prestamo_miercoles == 0) '' @else'{{$total_prestamo_miercoles}}' @endif
      ,{{$total_descompostura_miercoles}},@if($total_descompostura_miercoles == 0) '' @else'{{$total_descompostura_miercoles}}' @endif
      ,{{$total_taller_miercoles}}, @if($total_taller_miercoles == 0) '' @else'{{$total_taller_miercoles}}' @endif
      ,{{$total_corralon_miercoles}}, @if($total_corralon_miercoles == 0) '' @else'{{$total_corralon_miercoles}}' @endif
      ,{{$total_baja_miercoles}}, @if($total_baja_miercoles == 0) '' @else'{{$total_baja_miercoles}}' @endif
      ,
      ],
      ['{{$juevesDMY}}'
      ,{{$total_ruta_jueves}},@if($total_ruta_jueves == 0) '' @else'{{$total_ruta_jueves}}' @endif
      ,{{$total_baja_demanda_jueves}},@if($total_baja_demanda_jueves == 0) '' @else'{{$total_baja_demanda_jueves}}' @endif
      ,{{$total_prestamo_jueves}},@if($total_prestamo_jueves == 0) '' @else'{{$total_prestamo_jueves}}' @endif
      ,{{$total_descompostura_jueves}},@if($total_descompostura_jueves == 0) '' @else'{{$total_descompostura_jueves}}' @endif
      ,{{$total_taller_jueves}}, @if($total_taller_jueves == 0) '' @else'{{$total_taller_jueves}}' @endif
      ,{{$total_corralon_jueves}}, @if($total_corralon_jueves == 0) '' @else'{{$total_corralon_jueves}}' @endif
      ,{{$total_baja_jueves}}, @if($total_baja_jueves == 0) '' @else'{{$total_baja_jueves}}' @endif
      ,
      ],
      ['{{$viernesDMY}}'
      ,{{$total_ruta_viernes}},@if($total_ruta_viernes == 0) '' @else'{{$total_ruta_viernes}}' @endif
      ,{{$total_baja_demanda_viernes}},@if($total_baja_demanda_viernes == 0) '' @else'{{$total_baja_demanda_viernes}}' @endif
      ,{{$total_prestamo_viernes}},@if($total_prestamo_viernes == 0) '' @else'{{$total_prestamo_viernes}}' @endif
      ,{{$total_descompostura_viernes}},@if($total_descompostura_viernes == 0) '' @else'{{$total_descompostura_viernes}}' @endif
      ,{{$total_taller_viernes}}, @if($total_taller_viernes == 0) '' @else'{{$total_taller_viernes}}' @endif
      ,{{$total_corralon_viernes}}, @if($total_corralon_viernes == 0) '' @else'{{$total_corralon_viernes}}' @endif
      ,{{$total_baja_viernes}}, @if($total_baja_viernes == 0) '' @else'{{$total_baja_viernes}}' @endif
      ,
      ],
      ['{{$sabadoDMY}}'
      ,{{$total_ruta_sabado}},@if($total_ruta_sabado == 0) '' @else'{{$total_ruta_sabado}}' @endif
      ,{{$total_baja_demanda_sabado}},@if($total_baja_demanda_sabado == 0) '' @else'{{$total_baja_demanda_sabado}}' @endif
      ,{{$total_prestamo_sabado}},@if($total_prestamo_sabado == 0) '' @else'{{$total_prestamo_sabado}}' @endif
      ,{{$total_descompostura_sabado}},@if($total_descompostura_sabado == 0) '' @else'{{$total_descompostura_sabado}}' @endif
      ,{{$total_taller_sabado}}, @if($total_taller_sabado == 0) '' @else'{{$total_taller_sabado}}' @endif
      ,{{$total_corralon_sabado}}, @if($total_corralon_sabado == 0) '' @else'{{$total_corralon_sabado}}' @endif
      ,{{$total_baja_sabado}}, @if($total_baja_sabado == 0) '' @else'{{$total_baja_sabado}}' @endif
      ,
      ],
    ]);
      @endisset


      @isset($domingo)
      ['{{$lunesDMY}}'
      ,{{$total_ruta_lunes}},@if($total_ruta_lunes == 0) '' @else'{{$total_ruta_lunes}}' @endif
      ,{{$total_baja_demanda_lunes}},@if($total_baja_demanda_lunes == 0) '' @else'{{$total_baja_demanda_lunes}}' @endif
      ,{{$total_prestamo_lunes}},@if($total_prestamo_lunes == 0) '' @else'{{$total_prestamo_lunes}}' @endif
      ,{{$total_descompostura_lunes}},@if($total_descompostura_lunes == 0) '' @else'{{$total_descompostura_lunes}}' @endif
      ,{{$total_taller_lunes}}, @if($total_taller_lunes == 0) '' @else'{{$total_taller_lunes}}' @endif
      ,{{$total_corralon_lunes}}, @if($total_corralon_lunes == 0) '' @else'{{$total_corralon_lunes}}' @endif
      ,{{$total_baja_lunes}}, @if($total_baja_lunes == 0) '' @else'{{$total_baja_lunes}}' @endif
      ,
      ],
      
      ['{{$martesDMY}}'
      ,{{$total_ruta_martes}},@if($total_ruta_martes == 0) '' @else'{{$total_ruta_martes}}' @endif
      ,{{$total_baja_demanda_martes}},@if($total_baja_demanda_martes == 0) '' @else'{{$total_baja_demanda_martes}}' @endif
      ,{{$total_prestamo_martes}},@if($total_prestamo_martes == 0) '' @else'{{$total_prestamo_martes}}' @endif
      ,{{$total_descompostura_martes}},@if($total_descompostura_martes == 0) '' @else'{{$total_descompostura_martes}}' @endif
      ,{{$total_taller_martes}}, @if($total_taller_martes == 0) '' @else'{{$total_taller_martes}}' @endif
      ,{{$total_corralon_martes}}, @if($total_corralon_martes == 0) '' @else'{{$total_corralon_martes}}' @endif
      ,{{$total_baja_martes}}, @if($total_baja_martes == 0) '' @else'{{$total_baja_martes}}' @endif
      ,
      ],
      ['{{$miercolesDMY}}'
      ,{{$total_ruta_miercoles}},@if($total_ruta_miercoles == 0) '' @else'{{$total_ruta_miercoles}}' @endif
      ,{{$total_baja_demanda_miercoles}},@if($total_baja_demanda_miercoles == 0) '' @else'{{$total_baja_demanda_miercoles}}' @endif
      ,{{$total_prestamo_miercoles}},@if($total_prestamo_miercoles == 0) '' @else'{{$total_prestamo_miercoles}}' @endif
      ,{{$total_descompostura_miercoles}},@if($total_descompostura_miercoles == 0) '' @else'{{$total_descompostura_miercoles}}' @endif
      ,{{$total_taller_miercoles}}, @if($total_taller_miercoles == 0) '' @else'{{$total_taller_miercoles}}' @endif
      ,{{$total_corralon_miercoles}}, @if($total_corralon_miercoles == 0) '' @else'{{$total_corralon_miercoles}}' @endif
      ,{{$total_baja_miercoles}}, @if($total_baja_miercoles == 0) '' @else'{{$total_baja_miercoles}}' @endif
      ,
      ],
      ['{{$juevesDMY}}'
      ,{{$total_ruta_jueves}},@if($total_ruta_jueves == 0) '' @else'{{$total_ruta_jueves}}' @endif
      ,{{$total_baja_demanda_jueves}},@if($total_baja_demanda_jueves == 0) '' @else'{{$total_baja_demanda_jueves}}' @endif
      ,{{$total_prestamo_jueves}},@if($total_prestamo_jueves == 0) '' @else'{{$total_prestamo_jueves}}' @endif
      ,{{$total_descompostura_jueves}},@if($total_descompostura_jueves == 0) '' @else'{{$total_descompostura_jueves}}' @endif
      ,{{$total_taller_jueves}}, @if($total_taller_jueves == 0) '' @else'{{$total_taller_jueves}}' @endif
      ,{{$total_corralon_jueves}}, @if($total_corralon_jueves == 0) '' @else'{{$total_corralon_jueves}}' @endif
      ,{{$total_baja_jueves}}, @if($total_baja_jueves == 0) '' @else'{{$total_baja_jueves}}' @endif
      ,
      ],
      ['{{$viernesDMY}}'
      ,{{$total_ruta_viernes}},@if($total_ruta_viernes == 0) '' @else'{{$total_ruta_viernes}}' @endif
      ,{{$total_baja_demanda_viernes}},@if($total_baja_demanda_viernes == 0) '' @else'{{$total_baja_demanda_viernes}}' @endif
      ,{{$total_prestamo_viernes}},@if($total_prestamo_viernes == 0) '' @else'{{$total_prestamo_viernes}}' @endif
      ,{{$total_descompostura_viernes}},@if($total_descompostura_viernes == 0) '' @else'{{$total_descompostura_viernes}}' @endif
      ,{{$total_taller_viernes}}, @if($total_taller_viernes == 0) '' @else'{{$total_taller_viernes}}' @endif
      ,{{$total_corralon_viernes}}, @if($total_corralon_viernes == 0) '' @else'{{$total_corralon_viernes}}' @endif
      ,{{$total_baja_viernes}}, @if($total_baja_viernes == 0) '' @else'{{$total_baja_viernes}}' @endif
      ,
      ],
      ['{{$sabadoDMY}}'
      ,{{$total_ruta_sabado}},@if($total_ruta_sabado == 0) '' @else'{{$total_ruta_sabado}}' @endif
      ,{{$total_baja_demanda_sabado}},@if($total_baja_demanda_sabado == 0) '' @else'{{$total_baja_demanda_sabado}}' @endif
      ,{{$total_prestamo_sabado}},@if($total_prestamo_sabado == 0) '' @else'{{$total_prestamo_sabado}}' @endif
      ,{{$total_descompostura_sabado}},@if($total_descompostura_sabado == 0) '' @else'{{$total_descompostura_sabado}}' @endif
      ,{{$total_taller_sabado}}, @if($total_taller_sabado == 0) '' @else'{{$total_taller_sabado}}' @endif
      ,{{$total_corralon_sabado}}, @if($total_corralon_sabado == 0) '' @else'{{$total_corralon_sabado}}' @endif
      ,{{$total_baja_sabado}}, @if($total_baja_sabado == 0) '' @else'{{$total_baja_sabado}}' @endif
      ,
      ],
      ['{{$domingoDMY}}'
      ,{{$total_ruta_domingo}},@if($total_ruta_domingo == 0) '' @else'{{$total_ruta_domingo}}' @endif
      ,{{$total_baja_demanda_domingo}},@if($total_baja_demanda_domingo == 0) '' @else'{{$total_baja_demanda_domingo}}' @endif
      ,{{$total_prestamo_domingo}},@if($total_prestamo_domingo == 0) '' @else'{{$total_prestamo_domingo}}' @endif
      ,{{$total_descompostura_domingo}},@if($total_descompostura_domingo == 0) '' @else'{{$total_descompostura_domingo}}' @endif
      ,{{$total_taller_domingo}}, @if($total_taller_domingo == 0) '' @else'{{$total_taller_domingo}}' @endif
      ,{{$total_corralon_domingo}}, @if($total_corralon_domingo == 0) '' @else'{{$total_corralon_domingo}}' @endif
      ,{{$total_baja_domingo}}, @if($total_baja_domingo == 0) '' @else'{{$total_baja_domingo}}' @endif
      ,
      ],
    ]);
      @endisset


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
        
            legend: { position: 'top',
                      alignment: 'right', 
                      maxLines: 3,
                      textStyle: {
                      fontSize: 13,
                      bold: false,

                    }
            },

        width: 670,
        height: 430,

        chartArea: {
          'width': '85%',
          'height': '75%'

          //right: 100, // set this to adjust the legend width
          //left: 60, // set this to adjust the left margin
        },

        bar: { groupWidth: '75%' },
        isStacked: true,

        annotations: {
        
                alwaysOutside: false,
                highContrast: true,  // default is true, but be sure
                textStyle: {
                    bold: true,
                    fontSize: 18,

                }
            },
            colors: [

              @foreach($coloresEstatus as $color)
                    @if($color->nb_estatus == "Ruta")
                    '{{$color->nb_color}}',
                    @elseif($color->nb_estatus == "Baja demanda")
                    '{{$color->nb_color}}',
                    @elseif($color->nb_estatus == "Prestamo")
                    '{{$color->nb_color}}',
                    @elseif($color->nb_estatus == "Descompostura")
                    '{{$color->nb_color}}',
                    @elseif($color->nb_estatus == "Taller")
                    '{{$color->nb_color}}',
                    @elseif($color->nb_estatus == "Corralon")
                    '{{$color->nb_color}}',
                    @elseif($color->nb_estatus == "Baja")
                    '{{$color->nb_color}}',
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