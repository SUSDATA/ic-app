<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reclamacion>
 */
class ReclamacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
			'code' => $this->faker->unique()->regexify('[A-Z]{5}[0-4]{3}'),
			'segmento' => $this->faker->randomElement(['Empresas Grandes', 'Empresas Estrategicas', 'Negocios']),
			'operacion' => $this->faker->randomElement(['Fija', 'Movil']),
			'fecha' => $this->faker->dateTime(),
			'nit_rut' => $this->faker->unique()->regexify('[A-Z]{10}[0-9]{1}'),
			'razon_social' => $this->faker->unique()->word(),
			'valor_a_reclamar' => $this->faker->randomFloat(2),
			'id_venta' => $this->faker->unique()->randomNumber(8, true),
			'ot' => $this->faker->unique()->randomNumber(8, true),
			'ruta_archivo_adjunto' => $this->faker->shuffle('helloworld'),
			'aplica_min' => $this->faker->boolean(),
			'min' => $this->faker->e164PhoneNumber(),
			'tipo' => $this->faker->randomElement(['DIGITADA', 'INSTALADA']),
			'mes_reclamacion' => $this->faker->monthName(),
			'anio_reclamacion' => $this->faker->year(),
			'estado_id' => $this->faker->numberBetween(1,4),
			'consultor_id' => $this->faker->numberBetween(1,4),
			'resolutor_id' => $this->faker->numberBetween(1,4),
			'motivo_id' => $this->faker->numberBetween(1,4),
			'servicio_id' => $this->faker->numberBetween(1,4),
			'red_id' => $this->faker->numberBetween(1,4)
        ];
    }
}
