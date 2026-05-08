<?php

namespace Tests\Feature;

use App\Models\Almacenes;
use App\Models\Productos;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class QrCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_gets_svg_qr_code(): void
    {
        Http::preventStrayRequests();

        $user = User::factory()->create();
        $almacen = Almacenes::factory()->create(['id_user' => $user->id]);
        $producto = Productos::factory()->create([
            'id_user' => $user->id,
            'almacen' => $almacen->id,
        ]);

        $response = $this->actingAs($user)->get("/productos/{$producto->id}/qr.svg");

        $response->assertOk();
        $response->assertHeader('Content-Type', 'image/svg+xml');
        $this->assertStringContainsString('<svg', $response->getContent());
    }

    public function test_owner_gets_png_qr_code(): void
    {
        Http::preventStrayRequests();

        $user = User::factory()->create();
        $almacen = Almacenes::factory()->create(['id_user' => $user->id]);
        $producto = Productos::factory()->create([
            'id_user' => $user->id,
            'almacen' => $almacen->id,
        ]);

        $response = $this->actingAs($user)->get("/productos/{$producto->id}/qr.png");

        $response->assertOk();
        $response->assertHeader('Content-Type', 'image/png');
        $this->assertStringStartsWith("\x89PNG", $response->getContent());
    }

    public function test_foreign_user_cannot_access_qr_code(): void
    {
        $owner = User::factory()->create();
        $stranger = User::factory()->create();
        $almacen = Almacenes::factory()->create(['id_user' => $owner->id]);
        $producto = Productos::factory()->create([
            'id_user' => $owner->id,
            'almacen' => $almacen->id,
        ]);

        $this->actingAs($stranger)->get("/productos/{$producto->id}/qr.svg")->assertForbidden();
    }

    public function test_qr_code_endpoint_does_not_call_external_apis(): void
    {
        Http::preventStrayRequests();

        $user = User::factory()->create();
        $almacen = Almacenes::factory()->create(['id_user' => $user->id]);
        $producto = Productos::factory()->create([
            'id_user' => $user->id,
            'almacen' => $almacen->id,
        ]);

        $this->actingAs($user)->get("/productos/{$producto->id}/qr.svg")->assertOk();

        Http::assertNothingSent();
    }
}
