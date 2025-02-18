<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competencia;
use App\Models\CompetenciaMedio;
use Illuminate\Support\Facades\File;


class JsonImportController extends Controller
{
    public function showForm()
    {
        return view('importar-json');
    }

    public function importarJsonMedio()
{
    // Caminho do arquivo JSON no storage/app
    $caminho = storage_path('app/data.json');

    // Verifica se o arquivo JSON existe
    if (!File::exists($caminho)) {
        return response()->json(['message' => 'Arquivo JSON não encontrado'], 404);
    }

    // Lê o conteúdo do arquivo JSON
    $conteudo = File::get($caminho);

    // Decodifica o JSON em array associativo
    $dados = json_decode($conteudo, true);

    // Verifica se houve erro na decodificação
    if (json_last_error() !== JSON_ERROR_NONE) {
        return response()->json(['message' => 'Erro ao decodificar o JSON', 'error' => json_last_error_msg()], 400);
    }

    // Processa os dados e realiza a importação para o banco
    foreach ($dados as $dado) {
        CompetenciaMedio::create([
            'disciplina' => $dado['Column1'] ??' null',
                'serie' => $dado['Column2'] ?? null,
                'tema' => $dado['Column3'] ?? null,
                'descricao' => $dado['Column4'] ?? null,
                'habilidade' => $dado['Column5'] ?? null,
        ]);
    }

    return response()->json(['message' => 'Dados importados com sucesso!']);
}


    public function importJson(Request $request)
{
    // Valida o arquivo enviado
    $request->validate([
        'json_file' => 'required|file|mimes:json',
    ]);

    // Lê o conteúdo do arquivo JSON
    $file = $request->file('json_file');
    $json = file_get_contents($file->getRealPath());
    $data = json_decode($json, true);

    if (!$data) {
        return back()->withErrors(['json_file' => 'O arquivo JSON está mal formatado.']);
    }

    // Itera sobre as categorias no JSON
    foreach ($data as $categoria => $itens) {
        foreach ($itens as $item) {
            if ($categoria === 'Competências gerais' && isset($item[$categoria])) {
                // Importa "Competências gerais"
                Competencia::create([
                    'categoria' => $categoria,
                    'descricao' => $item[$categoria],
                ]);
            } elseif ($categoria != '' ) {
                // Importa "Língua Portuguesa"
                Competencia::create([
                    'categoria' => $categoria,
                    'ano_faixa' => $item['Column2'] ?? null,
                    'campos_atuacao' => $item['Column3'] ?? null,
                    'praticas_linguagem' => $item['Column4'] ?? null,
                    'objetos_conhecimento' => $item['Column5'] ?? null,
                    'descricao' => $item['Column6'] ?? null, // Salva o campo "Habilidades"
                ]);
            }
        }
    }

    return redirect()->back()->with('success', 'Dados importados com sucesso!');
}

    
}
