<?php

namespace App\Http\Controllers;

use App\Models\Musica;
use App\Services\MusicaService;
use Illuminate\Http\Request;

class MusicaController extends Controller
{

    public function listar()
    {
        try {
            $musicas = Musica::get()->toArray();
            return response()->json($musicas, 200);
        } catch (\Throwable $th) {
            return response()->json('Erro ao buscar', 500);
        }
    }

    public function visualizar($id)
    {
        try {
            $musica = Musica::find($id);
            $retorno = [
                'musica' => [
                    'titulo' => $musica->titulo . " - " . $musica->artista,
                    'id' => $musica->id
                ],
                'ordem' => $musica->formula,
                'partes' => $musica->partes->toArray()
            ];
            return response()->json($retorno, 200);
        } catch (\Throwable $th) {
            return response()->json('Erro ao buscar', 500);
        }
    }

    public function removerSecao(Request $request)
    {
        try {
            $musica = Musica::find($request->musica_id);
            $musica->partes()->detach($request->parte_id);
            return response()->json('Removido com Sucesso!', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function novaSecao(Request $request)
    {
        try {
            $musica = Musica::find($request->musica_id);
            $musica->partes()->attach([$request->parte_id => ['cifra' => 'cifra']]);
            return response()->json('Adicionado com Sucesso!', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function atualizarSecao(Request $request)
    {
        try {
            $musica = Musica::find($request->musica_id);
            $cifra = str_replace(' ', '&nbsp;', $request->cifra);
            $musica->partes()->updateExistingPivot(
                $request->parte_id,
                ['cifra' => $cifra]
            );
            return response()->json('Atualizado com Sucesso!', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function atualizarOrdem(Request $request)
    {
        try {
            $musica = Musica::find($request->musica_id);
            $musica->update(['formula' => $request->ordem]);
            return response()->json('Ordem Atualizada com Sucesso!', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function nova(Request $request)
    {
        try {
            $musica = Musica::create([
                'titulo' =>  $request->titulo,
                'artista' => $request->artista
            ]);
            return response()->json([$musica->toArray()], 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

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
