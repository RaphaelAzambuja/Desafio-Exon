<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Estrutura;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorio.index');
    }

    public function gerarRelatorio(Request $request)
    {
        $codigo_produto = $request->input('codigo_produto');
        $produto = Produto::find($codigo_produto);

        if (!$produto)
        {
            return redirect()->route('relatorios.index')->with('error', 'Produto não encontrado.');
        }

        $materiaPrima = $this->calcularMateriaPrima($produto);

        return view('relatorio.index', compact('produto', 'materiaPrima'));
    }

    public function relatorioMateriaPrima(Request $request, $codigo_produto)
    {
        $produto = Produto::find($codigo_produto);

        if (!$produto)
        {
            return response()->json(['error' => 'Produto não encontrado.'], 404);
        }

        $materiaPrima = $this->calcularMateriaPrima($produto);

        return view('relatorio.index', compact('produto', 'materiaPrima'));
    }

    private function calcularMateriaPrima(Produto $produto)
    {
        $materiaPrima = $this->recursaoMateriaPrima($produto);

        return $materiaPrima;
    }

    private function recursaoMateriaPrima(Produto $produto)
    {
        $codigoProdutoPai = $produto->codigo_produto;

        $estruturas = Estrutura::where('codigo_produto_pai', $codigoProdutoPai)->get();

        $materiaPrima = [];

        foreach ($estruturas as $estrutura)
        {
            $isPaiDeAlgumaEstrutura = Estrutura::where('codigo_produto_pai', $estrutura->codigo_produto_filho)->exists();

            if (!$isPaiDeAlgumaEstrutura)
            {
                $materiaPrima[] = [
                    'codigo_produto' => $estrutura->codigo_produto_filho,
                    'descricao' => Produto::find($estrutura->codigo_produto_filho)->descricao,
                    'quantidade' => $estrutura->quantidade,
                    'valor_total' => $estrutura->quantidade * Produto::find($estrutura->codigo_produto_filho)->custo_unitario,
                ];
            }
        }

        return $materiaPrima;
    }

}
