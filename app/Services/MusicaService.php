<?php

namespace App\Services;

use App\Models\Musica;

class MusicaService
{
    public static function montar(Musica $musica): array
    {
        try {
            $partes = $musica->partes->pluck('pivot.cifra', 'sigla')->toArray();
            $ordem = $musica->formula;
            return [
                'partes' => $partes,
                'ordem' => $ordem
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
