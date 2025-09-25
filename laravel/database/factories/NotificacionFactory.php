<?php
    namespace Database\Factories;
    use App\Models\Notificacion;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class NotificacionFactory extends Factory {
        protected $model = Notificacion::class;

        public function definition(): array {
            return [
                'destinatario_id' => User::factory(),
                'titulo' => $this->faker->sentence(3),
                'mensaje' => $this->faker->sentence(6),
                'visto' => false,
            ];
        }
    }
