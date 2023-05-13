<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EstadoReclamacion;

class EstadoReclamacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoReclamacion::create(
            [
                'nombre' => 'registrada',
                'nombre_a_mostrar' => 'Registrada',                
            ]
        );

        EstadoReclamacion::create(
            [
                'nombre' => 'en_tramite',
                'nombre_a_mostrar' => 'En tramite',                
            ]
        );

        EstadoReclamacion::create(
            [
                'nombre' => 'gestionada',
                'nombre_a_mostrar' => 'Gestionada',                
            ]
        );
    }
}
