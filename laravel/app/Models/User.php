<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class User extends Authenticatable {
        use HasFactory, Notifiable;

        protected $fillable = [
            'name',
            'apellidos',
            'telefono',
            'direccion',
            'ciudad',
            'comunidad_autonoma',
            'codigo_postal',
            'email',
            'password',
            'hotel_id',
            'rol',
            'pin_crear_usuari',
            'pin_eliminar_usuari',
            'pin_modificar_email_usuari',
        ];

        protected $hidden = [
            'password',
            'remember_token',
        ];

        protected function casts(): array {
            return [
                'email_verified_at' => 'datetime',
                'password' => 'hashed',
            ];
        }

        public function hotelesGestionados() {
            return $this->hasMany(Hotel::class, 'manager_id');
        }
    }
