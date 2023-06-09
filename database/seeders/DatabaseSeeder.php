<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
		$this->call(EstadoReclamacionSeeder::class);
        $this->call(MotivoReclamacionSeeder::class);
        $this->call(ServicioSeeder::class);
        $this->call(RedSeeder::class);

		//\App\Models\Servicio::factory(10)->create();
        //\App\Models\Red::factory(10)->create();
		//\App\Models\Motivo::factory(10)->create();		
        //\App\Models\EstadoReclamacion::factory(10)->create();        
		\App\Models\User::factory(10)->create();      
        \App\Models\Reclamacion::factory(1000)->create();
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',3
        //     'email' => 'test@example.com',
        // ]);

    }
}
