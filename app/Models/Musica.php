<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Musica extends Model
{
    protected $table = 'musicas';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'formula' => 'array'
    ];

    public function partes()
    {
        return $this->belongsToMany(Parte::class, 'parte_musicas')->withPivot('cifra');
    }
}
