<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Motivo;

class MotivoReclamacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Motivo::create(
            [
                'nombre' => 'no_aparece_legalizada',
                'nombre_a_mostrar' => 'No aparece legalizada',                
            ]
        );

        Motivo::create(
            [
                'nombre' => 'asignacion_errada',
                'nombre_a_mostrar' => 'Asignación errada',                
            ]
        );

        Motivo::create(
            [
                'nombre' => 'valores_errados',
                'nombre_a_mostrar' => 'Valores errados',                
            ]
        );

        Motivo::create(
            [
                'nombre' => 'no_aparece_digitada',
                'nombre_a_mostrar' => 'No aparece digitada',                
            ]
        );

        Motivo::create(
            [
                'nombre' => 'no_aparece_instalada',
                'nombre_a_mostrar' => 'No aparece instalada',                
            ]
        );

         Motivo::create(
            [
                'nombre' => 'no_aparece_alta',
                'nombre_a_mostrar' => 'No aparece alta',
            ]
        );

        Motivo::create(
            [
                'nombre' => 'baja_reportada',
                'nombre_a_mostrar' => 'Baja reportada',                
            ]
        );
    }
}
