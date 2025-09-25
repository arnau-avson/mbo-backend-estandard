<?php
    namespace Database\Factories;
    use App\Models\Formacion;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class FormacionFactory extends Factory {
        protected $model = Formacion::class;

        public function definition(): array {
            return [
                'user_id' => User::factory(),
                'titulo' => $this->faker->sentence(3),
                'institucion' => $this->faker->company(),
                'inicio_mes' => $this->faker->numberBetween(1, 12),
                'inicio_ano' => $this->faker->year(),
                'fin_mes' => $this->faker->numberBetween(1, 12),
                'fin_ano' => $this->faker->year(),
            ];
        }
    }
