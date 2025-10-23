<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProduto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = CategoriaProduto::all();
        return view('oficina.categoria.index', compact('categorias'));
    }

    public function create()
    {
        return view('oficina.categoria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        CategoriaProduto::create($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Serviço cadastrado com sucesso.');
    }

    public function show(CategoriaProduto $categoria)
    {
        return redirect()->route('categorias.edit', $categoria);
    }

    public function edit(CategoriaProduto $categoria)
    {
        return view('oficina.categoria.edit', compact('categoria'));
    }

    public function update(Request $request, CategoriaProduto $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Serviço atualizado com sucesso.');
    }

    public function destroy(CategoriaProduto $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Serviço excluído com sucesso.');
    }
}
