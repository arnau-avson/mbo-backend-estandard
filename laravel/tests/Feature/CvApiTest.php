<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CvApiTest extends TestCase
{
    use RefreshDatabase;


    public function test_add_experiencia_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('/api/cv/experiencia', [
            'titulo' => 'Camarero',
            'compania' => 'Hotel Luna',
            'inicio_mes' => 6,
            'inicio_ano' => 2022,
            'fin_mes' => 8,
            'fin_ano' => 2023,
            'ciudad' => 'Barcelona',
            'pais' => 'España'
        ]);
        $response->assertStatus(201);
    }

    public function test_update_experiencia_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $exp = \App\Models\Experiencia::factory()->create(['user_id' => $user->id]);
        $response = $this->putJson('/api/cv/experiencia/' . $exp->id, [
            'titulo' => 'Jefe de sala'
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_experiencia_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $exp = \App\Models\Experiencia::factory()->create(['user_id' => $user->id]);
        $response = $this->deleteJson('/api/cv/experiencia/' . $exp->id);
        $response->assertStatus(200);
    }


    public function test_add_formacion_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('/api/cv/formacion', [
            'titulo' => 'Grado en Turismo',
            'institucion' => 'UB',
            'inicio_mes' => 9,
            'inicio_ano' => 2020,
            'fin_mes' => 6,
            'fin_ano' => 2024
        ]);
        $response->assertStatus(201);
    }

    public function test_update_formacion_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $form = \App\Models\Formacion::factory()->create(['user_id' => $user->id]);
        $response = $this->putJson('/api/cv/formacion/' . $form->id, [
            'titulo' => 'Máster en Dirección Hotelera'
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_formacion_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $form = \App\Models\Formacion::factory()->create(['user_id' => $user->id]);
        $response = $this->deleteJson('/api/cv/formacion/' . $form->id);
        $response->assertStatus(200);
    }


    public function test_add_idioma_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('/api/cv/idioma', [
            'idioma' => 'Inglés',
            'nivel' => 'B2'
        ]);
        $response->assertStatus(201);
    }

    public function test_update_idioma_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $idioma = \App\Models\Idioma::factory()->create(['user_id' => $user->id]);
        $response = $this->putJson('/api/cv/idioma/' . $idioma->id, [
            'nivel' => 'C1'
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_idioma_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $idioma = \App\Models\Idioma::factory()->create(['user_id' => $user->id]);
        $response = $this->deleteJson('/api/cv/idioma/' . $idioma->id);
        $response->assertStatus(200);
    }

    public function test_add_dato_extra_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('/api/cv/dato-extra', [
            'tipo' => 'Carnet de conducir',
            'valor' => 'B'
        ]);
        $response->assertStatus(201);
    }

    public function test_update_dato_extra_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $dato = \App\Models\DatoExtra::factory()->create(['user_id' => $user->id]);
        $response = $this->putJson('/api/cv/dato-extra/' . $dato->id, [
            'valor' => 'B y A2'
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_dato_extra_endpoint()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $dato = \App\Models\DatoExtra::factory()->create(['user_id' => $user->id]);
        $response = $this->deleteJson('/api/cv/dato-extra/' . $dato->id);
        $response->assertStatus(200);
    }
}
