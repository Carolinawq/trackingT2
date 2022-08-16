<?php

namespace App\Imports;

use App\Models\Velocidade;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;



class VelocidadesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $fechaCruda = $row['fecha_inicio'];
        $fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fechaCruda));
        $fechaYMD = Carbon::parse($fecha)->format('Y-m-d');


        return new Velocidade([
            //
            'nb_unidad'     => $row['placa'],
            'ubicacion_inicio'    => $row['inicio_de_exceso'], 
            'ubicacion_fin'    => $row['fin_de_exceso'], 
            'duracion'    => $row['tiempo'],
            'velocidad'    => $row['velocidad'],
            'fecha'    => $fechaYMD, 
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}
