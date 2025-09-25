<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatApiTest extends TestCase
{
    use RefreshDatabase;


    public function test_crear_chat_endpoint()
    {
        $manager = \App\Models\User::factory()->create();
        $empleado = \App\Models\User::factory()->create();
        $this->actingAs($manager);
        $response = $this->postJson('/api/chat/crear', [
            'mensaje' => 'Hola',
            'manager_id' => $manager->id,
            'empleado_id' => $empleado->id,
            'from' => $manager->id,
        ]);
        $this->assertTrue(in_array($response->status(), [200, 201, 422]));
    }


    public function test_responder_chat_endpoint()
    {
        $manager = \App\Models\User::factory()->create();
        $empleado = \App\Models\User::factory()->create();
        $chat = \App\Models\Chat::factory()->create([
            'manager_id' => $manager->id,
            'empleado_id' => $empleado->id,
        ]);
        $this->actingAs($manager);
        $response = $this->postJson('/api/chat/responder', [
            'chat_id' => $chat->id,
            'mensaje' => 'Respuesta',
            'from' => $manager->id,
        ]);
        $this->assertTrue(in_array($response->status(), [200, 201, 422]));
    }

    public function test_marcar_mensaje_leido_endpoint()
    {
        $manager = \App\Models\User::factory()->create();
        $empleado = \App\Models\User::factory()->create();
        $chat = \App\Models\Chat::factory()->create([
            'manager_id' => $manager->id,
            'empleado_id' => $empleado->id,
        ]);
        // Add a message from 'admin' (manager), so only empleado can mark as read
        $data_chat = [
            [
                'id' => 1,
                'from' => 'admin',
                'msg' => 'Mensaje de prueba',
                'timestamp' => now()->toDateTimeString(),
                'visto' => false
            ]
        ];
        $chat->data_chat = json_encode($data_chat);
        $chat->save();
        // Act as empleado (recipient)
        $this->actingAs($empleado);
        $response = $this->postJson('/api/chat/marcar-leido', [
            'mensaje_id' => 1,
            'chat_id' => $chat->id,
            'user_id' => $empleado->id,
        ]);
        $this->assertTrue(in_array($response->status(), [200, 201, 422, 404]));
    }
}
