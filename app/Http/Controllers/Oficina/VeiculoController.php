<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Models\Veiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VeiculoController extends Controller
{
    public function create(Request $request)
    {
        $cliente_id = $request->query('cliente_id');
        if (!$cliente_id) {
            return redirect()->route('clientes.index')
                ->with('error', 'Cliente não especificado para adicionar veículo.');
        }

        $cliente = Cliente::findOrFail($cliente_id);
        return view('oficina.veiculo.create', ['cliente' => $cliente]);
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano' => 'required|integer|min:1900|max:2030',
            'placa' => ['required', 'string', 'max:10', Rule::unique('veiculos')],
        ]);

        $veiculo = Veiculo::create($dadosValidados);

        return redirect()->route('clientes.edit', $dadosValidados['cliente_id'])
            ->with('success', 'Veículo adicionado com sucesso!');
    }

    //Mostra o formulário para editar um veículo.
    public function edit(Veiculo $veiculo)
    {
        // O Laravel encontra o $veiculo pelo ID
        return view('oficina.veiculo.edit', ['veiculo' => $veiculo]);
    }

    public function update(Request $request, Veiculo $veiculo)
    {
        $dadosValidados = $request->validate([
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano' => 'required|integer|min:1900|max:2030',
            'placa' => ['required', 'string', 'max:10', Rule::unique('veiculos')->ignore($veiculo->id)],
        ]);

        $veiculo->update($dadosValidados);

        return redirect()->route('clientes.edit', $veiculo->cliente_id)
            ->with('success', 'Veículo atualizado com sucesso!');
    }

    public function destroy(Veiculo $veiculo)
    {
        $cliente_id = $veiculo->cliente_id;
        $veiculo->delete();
        return redirect()->route('clientes.edit', $cliente_id)
            ->with('success', 'Veículo deletado com sucesso.');
    }
}
