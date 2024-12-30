<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'caminho', 'status', 'user_id', 'aprovado_por'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function aprovadoPor()
    {
        return $this->belongsTo(User::class, 'aprovado_por');
    }
}
