<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_root_redirects_to_login_when_unauthenticated(): void
    {
        $this->get('/')->assertRedirect('/login');
    }

    public function test_login_page_loads(): void
    {
        $this->get('/login')->assertOk();
    }

    public function test_signup_page_loads(): void
    {
        $this->get('/signup')->assertOk();
    }

    public function test_protected_route_redirects_when_unauthenticated(): void
    {
        $this->get('/productos')->assertRedirect('/login');
        $this->get('/almacenes')->assertRedirect('/login');
        $this->get('/categorias')->assertRedirect('/login');
        $this->get('/qrscanner')->assertRedirect('/login');
    }
}
