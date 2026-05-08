<?php

namespace Tests\Feature;

use App\Models\Almacenes;
use App\Models\Categorias;
use App\Models\Estados;
use App\Models\Productos;
use App\Models\Productos_has_categorias;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductosViewTest extends TestCase
{
    use RefreshDatabase;

    private function makeProduct(User $owner, ?Almacenes $almacen = null, ?Categorias $categoria = null): Productos
    {
        $almacen ??= Almacenes::factory()->create(['id_user' => $owner->id]);
        $categoria ??= Categorias::factory()->create(['id_user' => $owner->id]);
        $producto = Productos::factory()->create([
            'id_user' => $owner->id,
            'almacen' => $almacen->id,
        ]);
        Productos_has_categorias::create([
            'id_producto' => $producto->id,
            'id_categoria' => $categoria->id,
        ]);
        return $producto;
    }

    public function test_pizarra_shows_empty_state_when_no_products(): void
    {
        $user = User::factory()->administrador()->create();

        $response = $this->actingAs($user)->get('/productos');

        $response->assertOk();
        $response->assertSee('Aún no tienes productos', false);
        $response->assertSee('Crear primer producto', false);
    }

    public function test_pizarra_renders_products_with_qr_endpoint(): void
    {
        $user = User::factory()->administrador()->create();
        $producto = $this->makeProduct($user);

        $response = $this->actingAs($user)->get('/productos');

        $response->assertOk();
        $response->assertSee($producto->nombre);
        $response->assertSee("/productos/{$producto->id}/qr.svg", false);
        $response->assertDontSee('Aún no tienes productos', false);
    }

    public function test_create_form_loads_with_categorias_and_almacenes(): void
    {
        $user = User::factory()->administrador()->create();
        Almacenes::factory()->create(['id_user' => $user->id, 'nombre' => 'Sede norte']);
        Categorias::factory()->create(['id_user' => $user->id, 'nombre' => 'Tornillería']);

        $response = $this->actingAs($user)->get('/crear-producto');

        $response->assertOk();
        $response->assertSee('Crear producto', false);
        $response->assertSee('Sede norte', false);
        $response->assertSee('Tornillería', false);
        $response->assertSee('Foto del producto', false);
    }

    public function test_detail_renders_qr_and_state_history(): void
    {
        $user = User::factory()->administrador()->create();
        $producto = $this->makeProduct($user);
        Estados::create([
            'id_producto' => $producto->id,
            'status' => 'en stock',
            'descripcion' => 'producto registrado',
        ]);

        $response = $this->actingAs($user)->get("/productos/{$producto->id}");

        $response->assertOk();
        $response->assertSee($producto->nombre);
        $response->assertSee('Historial de estados', false);
        $response->assertSee("/productos/{$producto->id}/qr.svg", false);
        $response->assertSee('En almacén', false);
    }

    public function test_delete_modal_shows_product_name(): void
    {
        $user = User::factory()->administrador()->create();
        $producto = $this->makeProduct($user, null, null);
        // Renombramos a algo controlado para evitar caracteres conflictivos del faker
        $producto->nombre = 'Tornillo M8';
        $producto->save();

        $response = $this->actingAs($user)->get("/productos/{$producto->id}");

        $response->assertOk();
        $response->assertSeeText('¿Eliminar "Tornillo M8"?', false);
        $response->assertSee('Eliminar producto', false);
    }
}
