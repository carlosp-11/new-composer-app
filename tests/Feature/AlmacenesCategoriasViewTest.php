<?php

namespace Tests\Feature;

use App\Models\Almacenes;
use App\Models\Categorias;
use App\Models\Productos;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlmacenesCategoriasViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_almacenes_pizarra_shows_empty_state_when_none(): void
    {
        $user = User::factory()->administrador()->create();

        $response = $this->actingAs($user)->get('/almacenes');

        $response->assertOk();
        $response->assertSee('Aún no tienes almacenes', false);
        $response->assertSee('Crear primer almacén', false);
    }

    public function test_almacenes_pizarra_shows_capacity_bar(): void
    {
        $user = User::factory()->administrador()->create();
        $almacen = Almacenes::factory()->create([
            'id_user' => $user->id,
            'nombre' => 'Sede norte',
            'slots' => 10,
        ]);
        Productos::factory()->count(7)->create([
            'id_user' => $user->id,
            'almacen' => $almacen->id,
        ]);

        $response = $this->actingAs($user)->get('/almacenes');

        $response->assertOk();
        $response->assertSee('Sede norte');
        $response->assertSee('7/10', false);
    }

    public function test_almacen_create_form_loads(): void
    {
        $user = User::factory()->administrador()->create();

        $response = $this->actingAs($user)->get('/crear-almacen');

        $response->assertOk();
        $response->assertSee('Crear almacén', false);
        $response->assertSee('Capacidad', false);
        $response->assertSee('Volver a almacenes', false);
    }

    public function test_categorias_pizarra_shows_empty_state(): void
    {
        $user = User::factory()->administrador()->create();

        $response = $this->actingAs($user)->get('/categorias');

        $response->assertOk();
        $response->assertSee('No hay categorías todavía', false);
        $response->assertSee('Crear primera categoría', false);
    }

    public function test_categoria_edit_form_shows_save_changes_button(): void
    {
        $user = User::factory()->administrador()->create();
        $categoria = Categorias::factory()->create([
            'id_user' => $user->id,
            'nombre' => 'Tornillería',
        ]);

        $response = $this->actingAs($user)->get("/categorias/{$categoria->id}/editar");

        $response->assertOk();
        $response->assertSee('Editar categoría', false);
        $response->assertSee('Guardar cambios', false);
        $response->assertDontSee('>Crear<', false);
    }

    public function test_private_account_renders_user_data(): void
    {
        $user = User::factory()->administrador()->create([
            'email' => 'admin@cdepot.test',
        ]);
        Almacenes::factory()->count(2)->create(['id_user' => $user->id]);

        $response = $this->actingAs($user)->get('/private');

        $response->assertOk();
        $response->assertSee('Mi cuenta', false);
        $response->assertSee('admin@cdepot.test', false);
        $response->assertSee('Administrador', false);
        $response->assertSee('Cerrar sesión', false);
    }
}
