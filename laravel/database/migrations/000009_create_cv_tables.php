<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up(): void {

            Schema::create('experiencias', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('titulo');
                $table->string('compania');
                $table->unsignedTinyInteger('inicio_mes');
                $table->unsignedSmallInteger('inicio_ano');
                $table->unsignedTinyInteger('fin_mes')->nullable();
                $table->unsignedSmallInteger('fin_ano')->nullable();
                $table->string('ciudad');
                $table->string('pais');
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });

            Schema::create('formaciones', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('titulo');
                $table->string('institucion');
                $table->unsignedTinyInteger('inicio_mes');
                $table->unsignedSmallInteger('inicio_ano');
                $table->unsignedTinyInteger('fin_mes')->nullable();
                $table->unsignedSmallInteger('fin_ano')->nullable();
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });

            Schema::create('idiomas', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('idioma');
                $table->string('nivel');
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });

            Schema::create('datos_extra', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('tipo');
                $table->string('valor');
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        public function down(): void {
            Schema::dropIfExists('experiencias');
            Schema::dropIfExists('formaciones');
            Schema::dropIfExists('idiomas');
            Schema::dropIfExists('datos_extra');
        }
    };
