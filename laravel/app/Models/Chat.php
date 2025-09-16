<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Chat extends Model {
        protected $fillable = [
            'manager_id',
            'empleado_id',
            'data_chat',
        ];

        public function manager() {
            return $this->belongsTo(User::class, 'manager_id');
        }

        public function empleado() {
            return $this->belongsTo(User::class, 'empleado_id');
        }
    }
