<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class GuestPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Halaman Home ( / ) dapat diakses dengan sukses.
     */
    public function test_home_page_can_be_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Quality laundry service in your city');
        $response->assertSee('LaundrKIT');
        $response->assertSee('/auth');
        $response->assertSee('/register');
    }

    /**
     * Test Halaman Login ( /auth ) menampilkan form dan inputan yang diminta.
     */
    public function test_login_page_renders_with_required_inputs(): void
    {
        $response = $this->get('/auth');

        $response->assertStatus(200);
        $response->assertSee('Masuk ke LaundrKIT');
        // Tersedia inputan: Username & Password
        $response->assertSee('name="username"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('Username');
        $response->assertSee('Password');
    }

    /**
     * Test Halaman Register ( /register ) menampilkan form dan inputan yang diminta.
     */
    public function test_register_page_renders_with_required_inputs(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Daftar Akun Baru');
        // Tersedia inputan: Name, Email, Password, Confirm Password
        $response->assertSee('name="name"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('name="password_confirmation"', false);
        $response->assertSee('Name');
        $response->assertSee('Email');
        $response->assertSee('Password');
        $response->assertSee('Confirm Password');
    }

    /**
     * Test proses pendaftaran akun (Register) berhasil menyimpan data pengguna.
     */
    public function test_user_can_register_successfully(): void
    {
        $response = $this->post('/register', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertRedirect('/admin-home');
        $this->assertDatabaseHas('users', [
            'email' => 'budi@example.com',
            'name' => 'Budi Santoso',
        ]);
        $this->assertAuthenticated();
    }

    /**
     * Soal 2: Logika sederhana login
     * Jika username dan password sama, arahkan ke halaman Dashboard Admin.
     */
    public function test_login_redirects_to_admin_dashboard_when_username_and_password_are_equal(): void
    {
        $response = $this->post('/auth', [
            'username' => 'admin',
            'password' => 'admin',
        ]);

        // Arahkan ke halaman Dashboard Admin
        $response->assertRedirect('/admin-home');
        $response->assertSessionHas('success');
    }

    /**
     * Soal 2: Logika sederhana login
     * Jika salah (username dan password tidak sama), arahkan kembali ke halaman Login dengan Alert.
     */
    public function test_login_redirects_back_to_login_with_alert_when_username_and_password_differ(): void
    {
        $response = $this->from('/auth')->post('/auth', [
            'username' => 'admin',
            'password' => 'wrongpass',
        ]);

        // Arahkan kembali ke halaman Login (/auth) dengan Alert
        $response->assertRedirect('/auth');
        $response->assertSessionHas('error');
    }

    /**
     * Test login juga dapat diproses melalui rute alias /login.
     */
    public function test_login_works_via_login_route_alias(): void
    {
        $response = $this->post('/login', [
            'username' => 'yessa',
            'password' => 'yessa',
        ]);

        $response->assertRedirect('/admin-home');
        $response->assertSessionHas('success');
    }
}

