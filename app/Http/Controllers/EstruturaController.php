<?php

namespace App\Http\Controllers;

use App\Models\Estrutura;
use App\Models\Produto;
use Illuminate\Http\Request;

class EstruturaController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('estruturas.index', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_produto_pai' => 'required|string|max:15|exists:produtos,codigo_produto',
            'codigo_produto_filho' => 'required|string|max:15|exists:produtos,codigo_produto',
            'quantidade' => 'required|integer|min:1',
        ]);

        try
        {
            Estrutura::create($request->all());

            return response()->json(['message' => 'Produto adicionado com sucesso']);
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function load(Request $request)
    {
        $request->validate([
            'codigo_produto_pai' => 'required|string|max:15|exists:produtos,codigo_produto',
        ]);

        $codigoProdutoPai = $request->codigo_produto_pai;

        $estrutura = Estrutura::where('codigo_produto_pai', $codigoProdutoPai)->get();

        if ($estrutura->isEmpty()) {
            return response()->json(['message' => 'Nenhuma estrutura encontrada para o código do produto pai fornecido.']);
        }

        return response()->json($estrutura);
    }


}
