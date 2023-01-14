<?php

namespace Database\Seeders;

use App\Models\Parte;
use Illuminate\Database\Seeder;

class ParteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partes = [
            [
                'titulo' => 'Intro',
                'sigla' => 'I',
                'cor' => '#550527'
            ],
            [
                'titulo' => 'Verso 1',
                'sigla' => 'V1',
                'cor' => '#688E26'
            ],
            [
                'titulo' => 'Verso 2',
                'sigla' => 'V2',
                'cor' => '#FAA613'
            ],
            [
                'titulo' => 'Verso 3',
                'sigla' => 'V3',
                'cor' => '#F44708'
            ],
            [
                'titulo' => 'Coro 1',
                'sigla' => 'C1',
                'cor' => '#D3C4D1'
            ],
            [
                'titulo' => 'Coro 2',
                'sigla' => 'C2',
                'cor' => '#FF729F'
            ],
            [
                'titulo' => 'Ponte',
                'sigla' => 'P',
                'cor' => '#A10702'
            ],
            [
                'titulo' => 'Pre-Refrao',
                'sigla' => 'PR',
                'cor' => '#EF798A'
            ],
        ];

        try {
            foreach ($partes as $parte) {
                Parte::updateOrCreate([
                    'sigla' => $parte['sigla']
                ], $parte);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
