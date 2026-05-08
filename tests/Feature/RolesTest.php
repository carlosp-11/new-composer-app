<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use RefreshDatabase;

    public function test_signup_assigns_administrador_role_by_default(): void
    {
        $this->post('/signup', [
            'email' => 'new@cdepot.test',
            'password' => 'password123',
        ])->assertRedirect('/');

        $user = User::where('email', 'new@cdepot.test')->first();
        $this->assertNotNull($user);
        $this->assertSame(User::ROLE_ADMIN, $user->role);
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isOperario());
    }

    public function test_role_middleware_blocks_wrong_role(): void
    {
        Route::middleware(['auth', 'role:administrador'])->get('/__test_admin_only', fn () => 'ok');

        $operario = User::factory()->create(['role' => User::ROLE_OPERARIO]);
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $this->actingAs($operario)->get('/__test_admin_only')->assertForbidden();
        $this->actingAs($admin)->get('/__test_admin_only')->assertOk();
    }

    public function test_role_middleware_accepts_multiple_roles(): void
    {
        Route::middleware(['auth', 'role:operario,administrador'])->get('/__test_any', fn () => 'ok');

        $this->actingAs(User::factory()->create(['role' => User::ROLE_OPERARIO]))
            ->get('/__test_any')->assertOk();
        $this->actingAs(User::factory()->create(['role' => User::ROLE_ADMIN]))
            ->get('/__test_any')->assertOk();
    }

    public function test_unauthenticated_user_redirects_to_login(): void
    {
        Route::middleware(['auth', 'role:administrador'])->get('/__test_unauth', fn () => 'ok');
        $this->get('/__test_unauth')->assertRedirect('/login');
    }
}
