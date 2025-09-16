<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Experiencia extends Model {
        use HasFactory;
        protected $table = 'experiencias';
        protected $fillable = [
            'user_id',
            'titulo',
            'compania',
            'inicio_mes',
            'inicio_ano',
            'fin_mes',
            'fin_ano',
            'ciudad',
            'pais'
        ];
    }
