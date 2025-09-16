<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class DatoExtra extends Model {
        use HasFactory;
        protected $table = 'datos_extra';
        protected $fillable = [
            'user_id',
            'tipo',
            'valor'
        ];
    }
