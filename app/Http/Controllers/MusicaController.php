<?php

namespace App\Http\Controllers;

use App\Models\Musica;
use App\Services\MusicaService;

class MusicaController extends Controller
{
    public function buscar($termo)
    {
        try {
            $musicas = Musica::where('titulo', 'like', '%' . $termo . '%')
                ->orWhere('artista', 'like', '%' . $termo . '%')
                ->get()
                ->toArray();
            return response()->json($musicas, 200);
        } catch (\Throwable $th) {
            return response()->json('Erro ao buscar', 500);
        }
    }

    public function baixar($id)
    {
        try {
            $musica = Musica::find($id);
            return response()->json(MusicaService::montar($musica), 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
