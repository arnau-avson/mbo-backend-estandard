<?php
    namespace Database\Factories;
    use App\Models\Idioma;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class IdiomaFactory extends Factory {
        protected $model = Idioma::class;

        public function definition(): array {
            return [
                'user_id' => User::factory(),
                'idioma' => $this->faker->languageCode(),
                'nivel' => $this->faker->randomElement(['A1','A2','B1','B2','C1','C2']),
            ];
        }
    }
