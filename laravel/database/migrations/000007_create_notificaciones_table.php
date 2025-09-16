<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up(): void {
            Schema::create('notificaciones', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('creado_por')->nullable();
                $table->unsignedBigInteger('destinatario_id');
                $table->string('titulo');
                $table->string('subtitulo')->nullable();
                $table->unsignedBigInteger('categoria_id')->nullable();
                $table->foreign('categoria_id')->references('id')->on('categorias_notificaciones')->nullOnDelete();
                $table->text('mensaje');
                $table->boolean('visto')->default(false);
                $table->timestamps();

                $table->foreign('creado_por')->references('id')->on('users')->nullOnDelete();
                $table->foreign('destinatario_id')->references('id')->on('users')->cascadeOnDelete();
            });
        }

        public function down(): void {
            Schema::dropIfExists('notificaciones');
        }
    };
