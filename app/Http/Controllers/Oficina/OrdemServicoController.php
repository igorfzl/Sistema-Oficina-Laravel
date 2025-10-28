<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Models\OrdemServico;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Produto;
use App\Models\Servico;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $ordens = OrdemServico::with(['cliente', 'veiculo', 'produto', 'servico'])
            ->orderBy('data_entrada', 'desc')
            ->get();

        return view('oficina.ordemservico.index', compact('ordens'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $veiculos = Veiculo::all();
        $produtos = Produto::all();
        $servicos = Servico::all();

        return view('oficina.ordemservico.create', compact('clientes', 'veiculos', 'produtos', 'servicos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'data_entrada' => 'required|date',
            'data_saida_prevista' => 'nullable|date|after_or_equal:data_entrada',
            'status' => 'required|string',
            'descricao_problema' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'produto_id' => 'nullable|exists:produtos,id',
            'produto_quantidade' => 'nullable|integer|min:1|required_with:produto_id',
            'servico_id' => 'nullable|exists:servicos,id',
        ]);

        $valorTotalProdutos = 0;
        $valorTotalServicos = 0;

        if (!empty($data['produto_id'])) {
            $produto = Produto::find($data['produto_id']);
            $valorTotalProdutos = $produto->valor * $data['produto_quantidade'];
        } else {
            $data['produto_quantidade'] = null;
        }

        if (!empty($data['servico_id'])) {
            $servico = Servico::find($data['servico_id']);
            $valorTotalServicos = $servico->valor;
        }

        $data['valor_total'] = $valorTotalProdutos + $valorTotalServicos;

        OrdemServico::create($data);

        return redirect()->route('ordemservicos.index')->with('success', 'Ordem de Serviço criada com sucesso!');
    }

    public function show(OrdemServico $ordemServico)
    {
        $ordemServico->load(['cliente', 'veiculo', 'produto', 'servico']);
        return view('oficina.ordemservico.show', compact('ordemServico'));
    }

    public function edit(OrdemServico $ordemServico)
    {
        $clientes = Cliente::all();
        $veiculos = Veiculo::all();
        $produtos = Produto::all();
        $servicos = Servico::all();

        return view('oficina.ordemservico.edit', compact('ordemServico', 'clientes', 'veiculos', 'produtos', 'servicos'));
    }

    public function update(Request $request, OrdemServico $ordemServico)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'data_entrada' => 'required|date',
            'data_saida_prevista' => 'nullable|date|after_or_equal:data_entrada',
            'status' => 'required|string',
            'descricao_problema' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'produto_id' => 'nullable|exists:produtos,id',
            'produto_quantidade' => 'nullable|integer|min:1|required_with:produto_id',
            'servico_id' => 'nullable|exists:servicos,id',
        ]);

        $valorTotalProdutos = 0;
        $valorTotalServicos = 0;

        if (!empty($data['produto_id'])) {
            $produto = Produto::find($data['produto_id']);
            $valorTotalProdutos = $produto->valor * $data['produto_quantidade'];
        } else {
            $data['produto_quantidade'] = null;
        }

        if (!empty($data['servico_id'])) {
            $servico = Servico::find($data['servico_id']);
            $valorTotalServicos = $servico->valor;
        }

        $data['valor_total'] = $valorTotalProdutos + $valorTotalServicos;

        $ordemServico->update($data);

        return redirect()->route('ordemservicos.index')->with('success', 'Ordem de Serviço atualizada com sucesso!');
    }

    public function destroy(OrdemServico $ordemServico)
    {
        $ordemServico->delete();
        return redirect()->route('ordemservicos.index')->with('success', 'Ordem de Serviço excluída com sucesso!');
    }
}
