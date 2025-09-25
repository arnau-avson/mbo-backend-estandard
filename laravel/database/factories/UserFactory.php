<?php
    namespace Database\Factories;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;

    class UserFactory extends Factory {
        protected static ?string $password;

        public function definition(): array {
            return [
                'name' => $this->faker->firstName(),
                'apellidos' => $this->faker->lastName(),
                'telefono' => $this->faker->numerify('6########'),
                'direccion' => $this->faker->address(),
                'ciudad' => $this->faker->city(),
                'comunidad_autonoma' => $this->faker->state(),
                'codigo_postal' => $this->faker->postcode(),
                'email' => $this->faker->unique()->safeEmail(),
                'password' => static::$password ??= Hash::make('password'),
                'hotel_id' => null,
                'rol' => 'EMPLEADOS',
                'pin_crear_usuari' => null,
                'pin_eliminar_usuari' => null,
                'pin_modificar_email_usuari' => null,
                'puntos' => 0,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ];
        }

        public function unverified(): static {
            return $this->state(fn (array $attributes) => [
                'email_verified_at' => null,
            ]);
        }
    }
