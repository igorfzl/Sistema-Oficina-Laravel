<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with(['cliente', 'produto'])->get();
        return view('oficina.venda.index', compact('vendas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('oficina.venda.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::find($data['produto_id']);

        $preco = $produto->valor;
        $data['valor_total'] = $data['quantidade'] * $preco;
        $data['data_venda'] = now();

        Venda::create($data);

        return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
    }

    public function show(Venda $venda)
    {
        $venda->load('produto');
        return view('oficina.venda.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('oficina.venda.edit', compact('venda', 'clientes', 'produtos'));
    }

    public function update(Request $request, Venda $venda)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::find($data['produto_id']);

        // CORREÇÃO: Usar apenas 'valor' para ser consistente com o método store()
        $preco = $produto->valor;
        $data['valor_total'] = $data['quantidade'] * $preco;

        $venda->update($data);

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda)
    {
        $venda->delete();
        return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso!');
    }
}
