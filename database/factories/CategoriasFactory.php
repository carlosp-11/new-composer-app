<?php

namespace Database\Factories;

use App\Models\Categorias;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriasFactory extends Factory
{
    protected $model = Categorias::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word(),
            'descripcion' => $this->faker->sentence(),
            'id_user' => User::factory(),
        ];
    }
}
