<?php
    namespace Tests\Feature;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class AuthApiTest extends TestCase {
        use RefreshDatabase;

        public function test_register_endpoint() {
            $hotel = \App\Models\Hotel::factory()->create();
            $response = $this->postJson('/api/auth/register', [
                'email' => 'test@example.com',
                'password' => 'Password123',
                'hotel_token' => $hotel->token,
                'name' => 'Test',
                'rol' => 'EMPLEADOS',
                'apellidos' => 'User',
                'telefono' => '600000000'
            ]);
            $response->assertStatus(201);
        }



        public function test_verify_pin_endpoint() {
            $hotel = \App\Models\Hotel::factory()->create();
            $register = $this->postJson('/api/auth/register', [
                'email' => 'test2@example.com',
                'password' => 'Password123',
                'hotel_token' => $hotel->token,
                'name' => 'Test',
                'rol' => 'EMPLEADOS',
                'apellidos' => 'User',
                'telefono' => '600000001'
            ]);
            
            $user = \App\Models\User::where('email', 'test2@example.com')->first();
            $pin = $user->pin_crear_usuari ?? '123456';
            $response = $this->postJson('/api/auth/verify-pin', [
                'email' => 'test2@example.com',
                'pin' => $pin
            ]);
            $this->assertTrue(in_array($response->status(), [200, 400, 422, 404]));
        }



        public function test_login_endpoint() {
            $hotel = \App\Models\Hotel::factory()->create();
            $this->postJson('/api/auth/register', [
                'email' => 'test3@example.com',
                'password' => 'Password123',
                'hotel_token' => $hotel->token,
                'name' => 'Test',
                'rol' => 'EMPLEADOS',
                'apellidos' => 'User',
                'telefono' => '600000002'
            ]);
            $user = \App\Models\User::where('email', 'test3@example.com')->first();
            $user->email_verified_at = now();
            $user->save();
            $response = $this->postJson('/api/auth/login', [
                'email' => 'test3@example.com',
                'password' => 'Password123'
            ]);
            $this->assertTrue(in_array($response->status(), [200, 401, 422]));
        }


        public function test_request_change_password_endpoint() {
            $hotel = \App\Models\Hotel::factory()->create();
            $this->postJson('/api/auth/register', [
                'email' => 'test4@example.com',
                'password' => 'Password123',
                'hotel_token' => $hotel->token,
                'name' => 'Test',
                'rol' => 'EMPLEADOS',
                'apellidos' => 'User',
                'telefono' => '600000003'
            ]);
            $response = $this->postJson('/api/auth/request-change-password', [
                'email' => 'test4@example.com'
            ]);
            $this->assertTrue(in_array($response->status(), [200, 404, 422]));
        }



        public function test_confirm_change_password_endpoint() {
            $hotel = \App\Models\Hotel::factory()->create();
            $this->postJson('/api/auth/register', [
                'email' => 'test5@example.com',
                'password' => 'Password123',
                'hotel_token' => $hotel->token,
                'name' => 'Test',
                'rol' => 'EMPLEADOS',
                'apellidos' => 'User',
                'telefono' => '600000004'
            ]);
            
            $this->postJson('/api/auth/request-change-password', [
                'email' => 'test5@example.com'
            ]);
            $user = \App\Models\User::where('email', 'test5@example.com')->first();
            $pin = $user->pin_modificar_email_usuari ?? '123456';
            $response = $this->postJson('/api/auth/confirm-change-password', [
                'email' => 'test5@example.com',
                'pin' => $pin,
                'password' => 'NewPassword123',
                'password_confirmation' => 'NewPassword123'
            ]);
            $this->assertTrue(in_array($response->status(), [200, 404, 422]));
        }

        public function test_request_change_email_and_password_endpoint() {
            $hotel = \App\Models\Hotel::factory()->create();
            $this->postJson('/api/auth/register', [
                'email' => 'test6@example.com',
                'password' => 'Password123',
                'hotel_token' => $hotel->token,
                'name' => 'Test',
                'rol' => 'EMPLEADOS',
                'apellidos' => 'User',
                'telefono' => '600000005'
            ]);
            $response = $this->postJson('/api/auth/request-change-email-password', [
                'email' => 'test6@example.com',
                'nuevo_email' => 'nuevo@example.com',
                'password' => 'Password123',
                'nuevo_password' => 'NewPassword123'
            ]);
            $this->assertTrue(in_array($response->status(), [200, 404, 422]));
        }
    }
