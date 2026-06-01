<?php

namespace App\Http\Controllers;

class ProgramaController extends Controller
{
    public function mesas()
    {
        $mesas = $this->leerCSV(
            storage_path('app/public/mesas.csv')
        );

        return view(
            'programa.mesas',
            compact('mesas')
        );
    }

    public function stands()
    {
        $stands = $this->leerCSV(
            storage_path('app/public/stands.csv')
        );

        return view(
            'programa.stands',
            compact('stands')
        );
    }

    private function leerCSV($archivo)
    {
        $datos = [];

        if (($handle = fopen($archivo, 'r')) !== false) {

            $headers = fgetcsv($handle, 1000, ',');

            while (($row = fgetcsv($handle, 1000, ',')) !== false) {

                $datos[] =
                    array_combine(
                        $headers,
                        $row
                    );
            }

            fclose($handle);
        }

        return $datos;
    }
}