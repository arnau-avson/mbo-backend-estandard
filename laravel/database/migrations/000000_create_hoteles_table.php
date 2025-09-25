<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up(): void {
            Schema::create('hoteles', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->string('token');
                $table->timestamps();
            });
        }

        public function down(): void {
            Schema::dropIfExists('hoteles');
        }
    };
