<?php

namespace Database\Factories;

use App\Models\Almacenes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlmacenesFactory extends Factory
{
    protected $model = Almacenes::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->words(2, true),
            'descripcion' => $this->faker->sentence(),
            'slots' => $this->faker->numberBetween(10, 500),
            'id_user' => User::factory(),
        ];
    }
}
