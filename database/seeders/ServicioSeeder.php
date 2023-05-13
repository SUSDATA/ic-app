<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servicio::create(
            [
                'nombre' => 'internet',
                'nombre_a_mostrar' => 'internet',                
            ]
        );

        Servicio::create(
            [
                'nombre' => 'tv',
                'nombre_a_mostrar' => 'tv',                
            ]
        );

        Servicio::create(
            [
                'nombre' => 'venta_cloud',
                'nombre_a_mostrar' => 'Venta cloud',                
            ]
        );

        Servicio::create(
            [
                'nombre' => 'ld_01_8000',
                'nombre_a_mostrar' => 'LD/01-8000',                
            ]
        );

        Servicio::create(
            [
                'nombre' => 'telefonia',
                'nombre_a_mostrar' => 'Telefonia',                
            ]
        );
    }
}
