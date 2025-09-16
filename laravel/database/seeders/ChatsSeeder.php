<?php
    namespace Database\Seeders;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\User;
    use App\Models\Chat;

    class ChatsSeeder extends Seeder {
        public function run(): void {
            $admin = User::where('rol', 'ADMINISTRADOR')->where('hotel_id', '!=', null)->first();
            $empleado = User::where('rol', 'EMPLEADOS')->where('hotel_id', $admin?->hotel_id)->first();

            if ($admin && $empleado) {
                Chat::create([
                    'manager_id' => $admin->id,
                    'empleado_id' => $empleado->id,
                    'data_chat' => json_encode([
                        [
                            'id' => 1,
                            'from' => 'admin',
                            'msg' => 'Hola, ¿cómo va el turno de hoy?',
                            'timestamp' => now()->toDateTimeString(),
                            'visto' => true
                        ],
                        [
                            'id' => 2,
                            'from' => 'empleado',
                            'msg' => '¡Hola! Todo bien, sin incidencias.',
                            'timestamp' => now()->toDateTimeString(),
                            'visto' => true
                        ],
                        [
                            'id' => 3,
                            'from' => 'admin',
                            'msg' => 'Perfecto, avísame si necesitas algo.',
                            'timestamp' => now()->toDateTimeString(),
                            'visto' => false
                        ],
                    ]),
                ]);
            }
        }
    }
