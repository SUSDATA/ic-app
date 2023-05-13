<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Red;

class RedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Red::create(
            [
                'nombre' => 'hfc',
                'nombre_a_mostrar' => 'hfc',                
            ]
        );

        Red::create(
            [
                'nombre' => 'ngn',
                'nombre_a_mostrar' => 'ngn',                
            ]
        );

        Red::create(
            [
                'nombre' => 'fo',
                'nombre_a_mostrar' => 'fo',                
            ]
        );

        Red::create(
            [
                'nombre' => 'cloud',
                'nombre_a_mostrar' => 'cloud',                
            ]
        );

        Red::create(
            [
                'nombre' => 'movil',
                'nombre_a_mostrar' => 'movil',                
            ]
        );

        Red::create(
            [
                'nombre' => 'fttx',
                'nombre_a_mostrar' => 'fttx',                
            ]
        );
    }
}
