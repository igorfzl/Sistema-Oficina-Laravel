<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Models\Veiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VeiculoController extends Controller
{
    /**
     * Mostra o formulário para criar um novo veículo.
     * Esta é a rota que o botão "+ Adicionar Veículo" chama.
     */
    public function create(Request $request)
    {
        // 1. Pega o 'cliente_id' que veio pela URL (?cliente_id=...)
        $cliente_id = $request->query('cliente_id');

        // 2. Se não foi passado um ID, não sabemos para quem cadastrar.
        if (!$cliente_id) {
            // Volta para a lista de clientes com um erro
            return redirect()->route('clientes.index')
                ->with('error', 'Cliente não especificado para adicionar veículo.');
        }

        // 3. Busca o cliente para podermos exibir o nome dele no formulário
        $cliente = Cliente::findOrFail($cliente_id);

        // 4. Mostra a view do formulário de cadastro de veículo
        return view('oficina.veiculo.create', ['cliente' => $cliente]);
    }

    /**
     * Salva o novo veículo no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Valida os dados do formulário
        $dadosValidados = $request->validate([
            'cliente_id' => 'required|exists:clientes,id', // Confirma que o cliente existe
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano' => 'required|integer|min:1900|max:2030',
            // Placa deve ser única, mas só para este cliente (opcional)
            // 'placa' => 'required|string|max:10|unique:veiculos,placa',
            // Placa única (simples)
            'placa' => ['required', 'string', 'max:10', Rule::unique('veiculos')],
        ]);

        // 2. Cria o veículo no banco
        $veiculo = Veiculo::create($dadosValidados);

        // 3. Redireciona de VOLTA para a página de EDIÇÃO do CLIENTE
        return redirect()->route('clientes.edit', $dadosValidados['cliente_id'])
            ->with('success', 'Veículo adicionado com sucesso!');
    }

    /**
     * Mostra o formulário para editar um veículo.
     */
    public function edit(Veiculo $veiculo)
    {
        // O Laravel já encontra o $veiculo pelo ID
        return view('oficina.veiculo.edit', ['veiculo' => $veiculo]);
    }

    /**
     * Atualiza o veículo no banco de dados.
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        $dadosValidados = $request->validate([
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano' => 'required|integer|min:1900|max:2030',
            'placa' => ['required', 'string', 'max:10', Rule::unique('veiculos')->ignore($veiculo->id)],
        ]);

        $veiculo->update($dadosValidados);

        // Redireciona de VOLTA para a página de EDIÇÃO do CLIENTE
        return redirect()->route('clientes.edit', $veiculo->cliente_id)
            ->with('success', 'Veículo atualizado com sucesso!');
    }

    /**
     * Deleta o veículo.
     */
    public function destroy(Veiculo $veiculo)
    {
        $cliente_id = $veiculo->cliente_id; // Pega o ID do cliente ANTES de deletar
        $veiculo->delete();

        // Redireciona de VOLTA para a página de EDIÇÃO do CLIENTE
        return redirect()->route('clientes.edit', $cliente_id)
            ->with('success', 'Veículo deletado com sucesso.');
    }
}
