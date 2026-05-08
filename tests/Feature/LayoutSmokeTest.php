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

    public function test_login_renders_with_new_layout_and_no_broken_assets(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertSee('Iniciar sesión', false);
        $response->assertDontSee('boxes_patern', false);
        $response->assertDontSee('depot_letter', false);
        $response->assertDontSee('cd_icon.png', false);
    }
}
