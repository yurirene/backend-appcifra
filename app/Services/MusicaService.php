<?php

namespace App\Services;

use App\Models\Musica;

class MusicaService
{
    public static function montar(Musica $musica): array
    {
        try {
            $partes = $musica->partes->map(function ($item) {
                $cifra = html_entity_decode($item->pivot->cifra);
                $cifra = str_replace("<br>", "\n", $cifra);
                $cifra = str_replace("&nbsp;", " ", $cifra);
                return [
                    $item->sigla => [
                        'sigla' => $item->sigla,
                        'cor' => $item->cor,
                        'cifra' => $cifra
                    ]
                ];
            })
            ->collapse()
            ->toArray();
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
