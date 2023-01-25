<?php

namespace App\Http\Controllers;

use App\Models\Musica;
use App\Models\Playlist;
use App\Services\MusicaService;

class CifraController extends Controller
{
    public function visualizar($id)
    {
        try {
            $musica = Musica::find($id);
            $retorno = MusicaService::montar($musica);
            $retorno['musica'] = $musica->toArray();
            return response()->json($retorno, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

}
