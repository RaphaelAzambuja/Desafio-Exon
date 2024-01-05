<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $filtro = $request->input('filtro');

        if ($request->expectsJson() && !empty($filtro))
        {
            $produtos = Produto::where('codigo_produto', 'LIKE', "%$filtro%")->orWhere('descricao', 'LIKE', "%$filtro%")->get();

            return response()->json($produtos);
        }

        $produtos = Produto::all();

        if ($request->expectsJson()) {
            return response()->json($produtos);
        }

        return view('produtos.index', ['produtos' => $produtos]);
    }


    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_produto' => 'required|string|max:15|unique:produtos',
            'descricao' => 'required|string',
            'custo_unitario' => 'required|numeric',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index');
    }

    public function show(string $codigo_produto)
    {
        $produto = Produto::findOrFail($codigo_produto);

        return view('produtos.show', compact('produto'));
    }

    public function edit(string $codigo_produto)
    {
        $produto = Produto::findOrFail($codigo_produto);

        return view('produtos.create', compact('produto'));
    }

    public function update(Request $request, string $codigo_produto)
    {
        $produto = Produto::findOrFail($codigo_produto);

        $request->validate([
            'codigo_produto' => 'required|string|max:15|unique:produtos,codigo_produto,' . $produto->codigo_produto.',codigo_produto',
            'descricao' => 'required|string',
            'custo_unitario' => 'required|numeric',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index');
    }

    public function destroy(string $codigo_produto)
    {
        $produto = Produto::findOrFail($codigo_produto);
        $produto->delete();

        return redirect()->route('produtos.index');
    }
}
