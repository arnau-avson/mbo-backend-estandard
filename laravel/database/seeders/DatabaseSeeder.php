<?php
    namespace Database\Seeders;
    use App\Models\User;
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder {
        public function run(): void {
            $this->call(HotelesSeeder::class);
            $this->call(ChatsSeeder::class);
            $hotelIds = \App\Models\Hotel::pluck('id')->toArray();

            User::unguard();
            // MODO DIOS ======================================
            User::create([
                'id' => 1,
                'name' => 'Arnau Barrero',
                'apellidos' => 'Barrero',
                'telefono' => '600000001',
                'email' => 'arnau@avson.eu',
                'password' => bcrypt('Arnau_2004'),
                'rol' => 'GOD',
                'email_verified_at' => now(),
            ]);

            // ADMIN DEL PRIMER HOTEL =========================
            User::create([
                'name' => 'Admin Hotel 1',
                'apellidos' => 'Admin',
                'telefono' => '600000002',
                'email' => 'admin1@hotel.com',
                'password' => bcrypt('Admin1_2025'),
                'rol' => 'ADMINISTRADOR',
                'hotel_id' => $hotelIds[0] ?? null,
                'email_verified_at' => now(),
            ]);

            // ADMIN DEL SEGUNDO HOTEL ========================
            User::create([
                'name' => 'Admin Hotel 2',
                'apellidos' => 'Admin',
                'telefono' => '600000003',
                'email' => 'admin2@hotel.com',
                'password' => bcrypt('Admin2_2025'),
                'rol' => 'ADMINISTRADOR',
                'hotel_id' => $hotelIds[1] ?? null,
                'email_verified_at' => now(),
            ]);

            // EMPLEADOS HOTEL 1 =========================
            User::create([
                'name' => 'Empleado1 Hotel 1',
                'apellidos' => 'Empleado',
                'telefono' => '600000004',
                'email' => 'empleado1_hotel1@hotel.com',
                'password' => bcrypt('Empleado1_2025'),
                'rol' => 'EMPLEADOS',
                'hotel_id' => $hotelIds[0] ?? null,
                'email_verified_at' => now(),
            ]);
            User::create([
                'name' => 'Empleado2 Hotel 1',
                'apellidos' => 'Empleado',
                'telefono' => '600000005',
                'email' => 'empleado2_hotel1@hotel.com',
                'password' => bcrypt('Empleado2_2025'),
                'rol' => 'EMPLEADOS',
                'hotel_id' => $hotelIds[0] ?? null,
                'email_verified_at' => now(),
            ]);
            User::create([
                'name' => 'Empleado3 Hotel 1',
                'apellidos' => 'Empleado',
                'telefono' => '600000006',
                'email' => 'empleado3_hotel1@hotel.com',
                'password' => bcrypt('Empleado3_2025'),
                'rol' => 'EMPLEADOS',
                'hotel_id' => $hotelIds[0] ?? null,
                'email_verified_at' => now(),
            ]);

            // EMPLEADOS HOTEL 2 =========================
            User::create([
                'name' => 'Empleado1 Hotel 2',
                'apellidos' => 'Empleado',
                'telefono' => '600000007',
                'email' => 'empleado1_hotel2@hotel.com',
                'password' => bcrypt('Empleado4_2025'),
                'rol' => 'EMPLEADOS',
                'hotel_id' => $hotelIds[1] ?? null,
                'email_verified_at' => now(),
            ]);
            User::create([
                'name' => 'Empleado2 Hotel 2',
                'apellidos' => 'Empleado',
                'telefono' => '600000008',
                'email' => 'empleado2_hotel2@hotel.com',
                'password' => bcrypt('Empleado5_2025'),
                'rol' => 'EMPLEADOS',
                'hotel_id' => $hotelIds[1] ?? null,
                'email_verified_at' => now(),
            ]);
            User::create([
                'name' => 'Empleado3 Hotel 2',
                'apellidos' => 'Empleado',
                'telefono' => '600000009',
                'email' => 'empleado3_hotel2@hotel.com',
                'password' => bcrypt('Empleado6_2025'),
                'rol' => 'EMPLEADOS',
                'hotel_id' => $hotelIds[1] ?? null,
                'email_verified_at' => now(),
            ]);

            User::reguard();
        }
    }
