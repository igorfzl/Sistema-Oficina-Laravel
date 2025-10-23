<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{

    public function home(){
        return view('oficina.index');
    }

    public function index()
    {
        // Usamos 'with('veiculos')' para carregar os veículos de forma otimizada (Eager Loading)
        // Evita que a view faça uma consulta no banco para cada cliente no loop
        $clientes = Cliente::with('veiculos')->latest()->get();
        return view('oficina.cliente.index', ['clientes' => $clientes]);
    }

    public function create()
    {
        return view('oficina.cliente.create');
    }

    public function store(Request $request)
    {
        // 1. Valida os dados que vieram do formulário
        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email', // 'unique' impede emails duplicados
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
        ]);

        // 2. Cria o cliente no banco com os dados validados
        $cliente = Cliente::create($dadosValidados);

        // 3. **A JOGADA**: Redireciona para a rota de EDIÇÃO (edit)
        //    passando o ID do cliente que acabou de ser criado.
        return redirect()->route('clientes.edit', $cliente->id)
            ->with('success', 'Cliente cadastrado! Agora você pode adicionar os veículos.');
    }

    public function show(Cliente $cliente)
    {
        return redirect()->route('clientes.edit', $cliente->id);
    }

    public function edit(Cliente $cliente)
    {
        $cliente->load('veiculos');
        return view('oficina.cliente.edit', ['cliente' => $cliente]);
    }

    public function update(Request $request, Cliente $cliente)
    {
        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('clientes')->ignore($cliente->id),
            ],
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
        ]);

        $cliente->update($dadosValidados);

        return redirect()->route('clientes.edit', $cliente->id)
            ->with('success', 'Cliente atualizado com sucesso.');
    }

    public function destroy(Cliente $cliente)
    {

        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deletado com sucesso.');
    }
}
