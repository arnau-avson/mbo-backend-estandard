<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;
    protected $table = 'mensajes';
    protected $fillable = [
        'chat_id',
        'user_id',
        'contenido',
        'leido',
    ];

    public function chat() {
        return $this->belongsTo(Chat::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
