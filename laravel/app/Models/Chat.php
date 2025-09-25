<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Chat extends Model {
        use HasFactory;
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
