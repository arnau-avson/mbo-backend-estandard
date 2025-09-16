<?php
    namespace Database\Seeders;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    use App\Models\Hotel;
    class HotelesSeeder extends Seeder {
        public static array $hotelIds = [];
        public function run(): void {
            $hoteles = [
                ['nombre' => 'Ushuaia Ibiza',   'token' => 'sol123sd'],
                ['nombre' => 'W Barcelona',     'token' => 'luna456a'],
                ['nombre' => 'Mandarin Dubai',  'token' => 'mar789zz'],
                ['nombre' => 'Solana Zurich',   'token' => 'cielo101'],
            ];
            foreach ($hoteles as $hotel) {
                $created = Hotel::create($hotel);
                self::$hotelIds[] = $created->id;
            }
        }
    }
