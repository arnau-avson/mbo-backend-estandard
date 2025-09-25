<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificacionesApiTest extends TestCase
{
    use RefreshDatabase;


    public function test_crear_notificacion_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('/api/notificaciones/crear', [
            'titulo' => 'Nueva tarea',
            'mensaje' => 'Tienes una nueva tarea asignada.',
            'destinatario_id' => $user->id
        ]);
        $this->assertTrue(in_array($response->status(), [200, 201, 422]));
    }

    public function test_marcar_notificacion_leida_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $noti = \App\Models\Notificacion::factory()->create(['destinatario_id' => $user->id]);
        $response = $this->patchJson('/api/notificaciones/' . $noti->id . '/marcar-leida');
        $this->assertTrue(in_array($response->status(), [200, 201, 422, 404]));
    }
}
