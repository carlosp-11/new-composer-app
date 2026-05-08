<?php

namespace Tests\Feature;

use App\Models\Almacenes;
use App\Models\Categorias;
use App\Models\Images;
use App\Models\Productos;
use App\Models\Productos_has_categorias;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrossTenantIsolationTest extends TestCase
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

        Images::create([
            'nombre' => 'foto',
            'url' => "https://cdn.example/{$producto->id}.jpg",
            'id_producto' => $producto->id,
        ]);

        return $producto;
    }

    public function test_index_does_not_expose_other_tenant_images_or_categories(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $this->makeProduct($userA);
        $foreign = $this->makeProduct($userB);

        $response = $this->actingAs($userA)->get('/productos');

        $response->assertOk();
        $response->assertViewHas('imagenes', function ($imagenes) use ($foreign) {
            return ! $imagenes->contains('id_producto', $foreign->id);
        });
        $response->assertViewHas('productosCategorias', function ($rels) use ($foreign) {
            return ! $rels->contains('id_producto', $foreign->id);
        });
    }

    public function test_show_search_does_not_leak_foreign_products(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        Productos::factory()->create(['id_user' => $userA->id, 'nombre' => 'mio especial']);
        Productos::factory()->create(['id_user' => $userB->id, 'nombre' => 'mio especial ajeno']);

        $response = $this->actingAs($userA)->post('/productos', [
            'termino' => 'mio especial',
        ]);

        $response->assertOk();
        $body = $response->json();
        $this->assertCount(1, $body['productos']['data']);
        $this->assertSame('mio especial', $body['productos']['data'][0]['nombre']);
    }

    public function test_show_image_endpoint_blocks_foreign_image(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $foreignProduct = $this->makeProduct($userB);
        $foreignImage = Images::where('id_producto', $foreignProduct->id)->first();

        $this->actingAs($userA)->get("/images/{$foreignImage->id}")->assertForbidden();
    }
}
