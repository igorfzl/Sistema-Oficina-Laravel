<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\CategoriaProduto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function index()
    {

        $produtos = Produto::with('categoriaProduto')->get();
        return view('oficina.produto.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = CategoriaProduto::all();

        return view('oficina.produto.create', compact('categorias'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor' => 'required|numeric|min:0',
            'categoria_produto_id' => 'required|exists:categoria_produtos,id' // Validação da categoria
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso.');
    }

    public function edit(Produto $produto)
    {
        $categorias = CategoriaProduto::all();
        return view('oficina.produto.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor' => 'required|numeric|min:0',
            'categoria_produto_id' => 'required|exists:categoria_produtos,id'
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')
            ->with('success', 'Produto excluído com sucesso.');
    }
}
