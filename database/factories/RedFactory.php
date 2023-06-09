<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Red>
 */
class RedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word,
            'nombre_a_mostrar' => $this->faker->unique()->word,
			'descripcion' => $this->faker->paragraph,			
			'usuario_creacion' => $this->faker->name,
			'usuario_modificacion' => $this->faker->name,
        ];
    }
}
