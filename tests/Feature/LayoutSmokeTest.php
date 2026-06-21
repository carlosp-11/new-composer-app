<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayoutSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_renders_pizarra_with_new_layout(): void
    {
        $admin = User::factory()->administrador()->create();

        $response = $this->actingAs($admin)->get('/productos');

        $response->assertOk();
        $response->assertSee('C-DEPOT', false);
        $response->assertSee('Administrador', false);
    }

    public function test_authenticated_operario_renders_pizarra_without_admin_chips(): void
    {
        $operario = User::factory()->operario()->create();

        $response = $this->actingAs($operario)->get('/productos');

        $response->assertOk();
        $response->assertSee('Operario', false);
        $response->assertDontSee('Administrador', false);
    }

    public function test_login_renders_with_new_layout(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertSee('Iniciar sesión', false);
        $response->assertSee('cdepot_icon.png', false);
    }
}
