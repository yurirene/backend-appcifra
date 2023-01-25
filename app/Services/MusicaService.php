<?php

namespace App\Services;

use App\Models\Musica;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MusicaService
{
    public static function montar(Musica $musica): array
    {
        try {
            $partes = $musica->partes->map(function ($item) {
                $cifra = html_entity_decode($item->pivot->cifra);
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

    public static function baixar(Musica $musica)
    {
        try {
            $ordem = $musica->formula;
            $partes = $musica->partes->map(function ($item) {
                $cifra = strip_tags($item->pivot->cifra);
                $cifra = str_replace("&nbsp;", " ", $cifra);
                $cifra = html_entity_decode($cifra);
                return [
                    $item->sigla => $cifra
                ];
            })
            ->collapse()
            ->toArray();
            $texto = "";
            foreach ($ordem as $ord) {
                $texto .= $partes[$ord] . PHP_EOL . PHP_EOL . PHP_EOL;
            }
            $filename = $musica->titulo.'.txt';
            $nome = "public/cifras/$filename";
            Storage::put($nome, $texto, 'public');

            $headers = [
                'Content-Type' => 'text/plain',
                'Access-Control-Allow-Origin' => '*',
            ];
            return Storage::download($nome, $filename, $headers);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
