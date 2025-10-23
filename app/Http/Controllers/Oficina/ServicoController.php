<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServicoController extends Controller
{
    public function index()
    {
        $servicos = Servico::all();
        return view('oficina.servico.index', compact('servicos'));
    }

    public function create()
    {
        return view('oficina.servico.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor' => 'required|numeric|min:0',
        ]);

        Servico::create($request->all());

        return redirect()->route('servicos.index')
                         ->with('success', 'Serviço cadastrado com sucesso.');
    }

    public function show(Servico $servico)
    {
        return redirect()->route('servicos.edit', $servico);
    }

    public function edit(Servico $servico)
    {
        return view('oficina.servico.edit', compact('servico'));
    }

    public function update(Request $request, Servico $servico)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor' => 'required|numeric|min:0',
        ]);

        $servico->update($request->all());

        return redirect()->route('servicos.index')
                         ->with('success', 'Serviço atualizado com sucesso.');
    }

    public function destroy(Servico $servico)
    {
        $servico->delete();

        return redirect()->route('servicos.index')
                         ->with('success', 'Serviço excluído com sucesso.');
    }
}
