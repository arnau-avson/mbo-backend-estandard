<?php
    namespace Database\Factories;
    use App\Models\Experiencia;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class ExperienciaFactory extends Factory {
        protected $model = Experiencia::class;

        public function definition(): array {
            return [
                'user_id' => User::factory(),
                'titulo' => $this->faker->jobTitle(),
                'compania' => $this->faker->company(),
                'inicio_mes' => $this->faker->numberBetween(1, 12),
                'inicio_ano' => $this->faker->year(),
                'fin_mes' => $this->faker->numberBetween(1, 12),
                'fin_ano' => $this->faker->year(),
                'ciudad' => $this->faker->city(),
                'pais' => $this->faker->country(),
            ];
        }
    }
