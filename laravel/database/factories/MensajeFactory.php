<?php
    namespace Database\Factories;
    use App\Models\Mensaje;
    use App\Models\Chat;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class MensajeFactory extends Factory {
        protected $model = Mensaje::class;

        public function definition(): array {
            return [
                'chat_id' => Chat::factory(),
                'user_id' => User::factory(),
                'contenido' => $this->faker->sentence(6),
                'leido' => false,
            ];
        }
    }
