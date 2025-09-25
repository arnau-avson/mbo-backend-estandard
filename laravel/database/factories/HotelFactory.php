<?php
    namespace Database\Factories;
    use App\Models\Hotel;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class HotelFactory extends Factory {
        protected $model = Hotel::class;

        public function definition(): array {
            return [
                'nombre' => $this->faker->company(),
                'token' => $this->faker->unique()->regexify('[a-z0-9]{8}'),
                'manager_id' => null,
            ];
        }
    }
