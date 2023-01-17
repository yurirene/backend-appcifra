<?php

namespace App\Http\Controllers;

use App\Models\Musica;
use App\Models\Playlist;
use App\Services\MusicaService;

class PlaylistController extends Controller
{
    public function listar()
    {
        try {
            $playlist = Playlist::orderBy('dia', 'desc')
                ->get()
                ->toArray();
            return response()->json($playlist, 200);
        } catch (\Throwable $th) {
            return response()->json('Erro ao listar', 500);
        }
    }

    public function musicas($id)
    {
        try {
            $playlist = Playlist::find($id);
            $musicas = $playlist->musicas;
            return response()->json([
                'musicas' => $musicas,
                'playlist' => $playlist
            ], 200);
        } catch (\Throwable $th) {
            return response()->json('Erro ao listar músicas', 500);
        }
    }

}
