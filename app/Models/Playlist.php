<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = 'playlist';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $appends = ['data_playlist'];
    protected $dates = ['dia'];

    public function getDataPlaylistAttribute()
    {
        return $this->dia->format('d/m/Y');
    }

    public function musicas()
    {
        return $this->belongsToMany(Musica::class, 'playlist_musica');
    }
}
