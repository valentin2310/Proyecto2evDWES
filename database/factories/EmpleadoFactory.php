<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Empleado::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'correo' => $this->faker->email(),
            'telefono' => $this->faker->phoneNumber(),
            'tipo' => 0,
            'password' => bcrypt('admin'),
            'nif' => '30313472R'
        ];
    }
}
