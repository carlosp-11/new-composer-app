<?php

namespace Tests\Feature;

use App\Models\Almacenes;
use App\Models\Categorias;
use App\Models\Estados;
use App\Models\Productos;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_shows_stats_for_user_only(): void
    {
        $admin = User::factory()->administrador()->create();
        $other = User::factory()->administrador()->create();

        $almacen = Almacenes::factory()->create(['id_user' => $admin->id]);
        Almacenes::factory()->count(5)->create(['id_user' => $other->id]);
        Categorias::factory()->count(3)->create(['id_user' => $admin->id]);
        Productos::factory()->count(4)->create([
            'id_user' => $admin->id,
            'almacen' => $almacen->id,
        ]);

        $response = $this->actingAs($admin)->get('/');

        $response->assertOk();
        $response->assertViewHas('stats', fn ($stats) => $stats['almacenes'] === 1
            && $stats['categorias'] === 3
            && $stats['productos'] === 4
            && $stats['incidencias'] === 0);
    }

    public function test_admin_sees_onboarding_progress_when_incomplete(): void
    {
        $admin = User::factory()->administrador()->create();
        Almacenes::factory()->create(['id_user' => $admin->id]);

        $response = $this->actingAs($admin)->get('/');

        $response->assertOk();
        $response->assertSee('Primeros pasos', false);
        $response->assertSee('1/3', false);
    }

    public function test_admin_does_not_see_checklist_when_complete(): void
    {
        $admin = User::factory()->administrador()->create();
        $almacen = Almacenes::factory()->create(['id_user' => $admin->id]);
        Categorias::factory()->create(['id_user' => $admin->id]);
        Productos::factory()->create(['id_user' => $admin->id, 'almacen' => $almacen->id]);

        $response = $this->actingAs($admin)->get('/');

        $response->assertOk();
        $response->assertDontSee('Primeros pasos', false);
    }

    public function test_operario_sees_action_cards_dashboard(): void
    {
        $operario = User::factory()->operario()->create();

        $response = $this->actingAs($operario)->get('/');

        $response->assertOk();
        $response->assertSee('Registrar producto', false);
        $response->assertSee('Escanear código QR', false);
        $response->assertSee('Ver mis productos', false);
        $response->assertDontSee('Primeros pasos', false);
        $response->assertDontSee('Incidencias', false);
    }

    public function test_dashboard_counts_only_latest_state_with_incidence(): void
    {
        $admin = User::factory()->administrador()->create();
        $almacen = Almacenes::factory()->create(['id_user' => $admin->id]);

        $producto = Productos::factory()->create(['id_user' => $admin->id, 'almacen' => $almacen->id]);
        Estados::create(['id_producto' => $producto->id, 'status' => 'con incidencia', 'descripcion' => 'rotura']);
        Estados::create(['id_producto' => $producto->id, 'status' => 'en stock', 'descripcion' => 'reparado']);

        $response = $this->actingAs($admin)->get('/');

        $response->assertOk();
        $response->assertViewHas('stats', fn ($stats) => $stats['incidencias'] === 0);
    }
}
