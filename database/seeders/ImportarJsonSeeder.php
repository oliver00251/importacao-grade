<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competencia;
use Illuminate\Support\Facades\File;

class ImportarJsonSeeder extends Seeder
{
    public function run()
    {
        // Carrega o arquivo JSON
        $json = File::get(database_path('data/dados.json')); // Coloque o caminho correto do seu arquivo
        $data = json_decode($json, true);

        // Itera sobre cada categoria no JSON
        foreach ($data as $categoria => $itens) {
            foreach ($itens as $item) {
                // Verifica se o item é um array com descrição
                if (isset($item[$categoria])) {
                    Competencia::create([
                        'categoria' => $categoria,
                        'descricao' => $item[$categoria],
                    ]);
                } elseif (isset($item['Column6'])) {
                    // Lida com a estrutura específica de "Língua Portuguesa"
                    Competencia::create([
                        'categoria' => $categoria,
                        'descricao' => $item['Column6'], // Adiciona a habilidade
                    ]);
                }
            }
        }
    }
}
