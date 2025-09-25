<?php
    namespace Database\Factories;
    use App\Models\Chat;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class ChatFactory extends Factory {
        protected $model = Chat::class;

        public function definition(): array {
            return [
                'manager_id' => User::factory(),
                'empleado_id' => User::factory(),
                'data_chat' => now(),
            ];
        }
    }
