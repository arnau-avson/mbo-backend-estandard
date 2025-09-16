<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Notificacion extends Model {
        use HasFactory;
        protected $table = 'notificaciones';
        protected $fillable = [
            'creado_por', 
            'destinatario_id', 
            'titulo', 
            'subtitulo', 
            'mensaje', 
            'visto', 
            'categoria_id'
        ];

        public function categoria() {
            return $this->belongsTo(CategoriaNotificacion::class, 'categoria_id');
        }

        public function creador() {
            return $this->belongsTo(User::class, 'creado_por');
        }

        public function destinatario(){
            return $this->belongsTo(User::class, 'destinatario_id');
        }
    }
