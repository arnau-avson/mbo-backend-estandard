<?php
    namespace Database\Factories;

    use App\Models\DatoExtra;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class DatoExtraFactory extends Factory {
        protected $model = DatoExtra::class;

        public function definition(): array {
            return [
                'user_id' => User::factory(),
                'tipo' => $this->faker->word(),
                'valor' => $this->faker->word(),
            ];
        }
    }
