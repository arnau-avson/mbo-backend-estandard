<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Hotel extends Model {
        protected $table = 'hoteles';
        protected $fillable = [
            'nombre',
            'token',
            'manager_id',
        ];

        public function manager()
        {
            return $this->belongsTo(User::class, 'manager_id');
        }
    }
