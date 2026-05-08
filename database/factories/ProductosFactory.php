<?php

namespace Database\Factories;

use App\Models\Almacenes;
use App\Models\Productos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductosFactory extends Factory
{
    protected $model = Productos::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(3, true),
            'precio' => $this->faker->randomFloat(2, 1, 999),
            'descripcion' => $this->faker->sentence(),
            'almacen' => Almacenes::factory(),
            'id_user' => User::factory(),
        ];
    }
}
