<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Admin');
    }

    public function test_admin_home_returns_successful_response(): void
    {
        $response = $this->get('/admin-home');

        $response->assertStatus(200);
        $response->assertSee('Dashboard Admin 🎀');
        $response->assertSee('Data Pelanggan');
        $response->assertSee('Data Layanan Cuci');
        $response->assertSee('Data Perlengkapan');
    }
}
