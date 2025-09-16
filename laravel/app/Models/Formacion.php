<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Formacion extends Model {
        use HasFactory;
        protected $table = 'formaciones';
        protected $fillable = [
            'user_id',
            'titulo',
            'institucion',
            'inicio_mes',
            'inicio_ano',
            'fin_mes',
            'fin_ano'
        ];
    }
