<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class CategoriaNotificacion extends Model {
        use HasFactory;
        protected $table = 'categorias_notificaciones';
        protected $fillable = [
            'nombre', 
            'descripcion'
        ];

        public function notificaciones() {
            return $this->hasMany(Notificacion::class, 'categoria_id');
        }
    }
