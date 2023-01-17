<?php

namespace App\Http\Controllers;

use App\Models\Musica;
use App\Models\Playlist;
use App\Services\MusicaService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            return response()->json($th->getMessage(), 500);
        }
    }

    public function nova(Request $request)
    {
        try {
            $playlist = Playlist::create([
                'titulo' => $request->titulo,
                'dia' => Carbon::createFromFormat('d/m/Y', $request->dia)->format('Y-m-d')
            ]);
            return response()->json($playlist, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function addMusica(Request $request)
    {
        try {
            $playlist = Playlist::find($request->playlist_id);
            $playlist->musicas()->attach($request->musica_id);
            return response()->json('Música adicionada', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function removerMusica(Request $request)
    {
        try {
            $playlist = Playlist::find($request->playlist_id);
            $playlist->musicas()->detach($request->musica_id);
            return response()->json('Música removida', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function remover(Request $request)
    {
        try {
            $playlist = Playlist::find($request->playlist_id);
            $playlist->musicas()->sync([]);
            $playlist->delete();
            return response()->json('Playlist Removida', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
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
