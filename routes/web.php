<?php

use App\Http\Controllers\Oficina\RelatorioController;
use App\Http\Controllers\Oficina\OrdemServicoController;
use App\Http\Controllers\Oficina\CategoriaController;
use App\Http\Controllers\Oficina\ServicoController;
use App\Http\Controllers\Oficina\ClienteController;
use App\Http\Controllers\Oficina\ProdutoController;
use App\Http\Controllers\Oficina\VeiculoController;
use App\Http\Controllers\Oficina\VendaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->prefix('oficina')->group(function () {

    Route::get('/', [ClienteController::class, 'home'])->name('oficina.index');

    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
    Route::get('/relatorios/faturamento', [RelatorioController::class, 'faturamento'])->name('relatorios.faturamento');
    Route::get('/relatorios/top-clientes', [RelatorioController::class, 'topClientes'])->name('relatorios.top-clientes');
    Route::get('/relatorios/top-produtos', [RelatorioController::class, 'topProdutos'])->name('relatorios.top-produtos');
    Route::get('/relatorios/top-servicos', [RelatorioController::class, 'topServicos'])->name('relatorios.top-servicos');
    Route::get('/relatorios/os-por-status', [RelatorioController::class, 'osPorStatus'])->name('relatorios.os-por-status');

    Route::get('/ordemservicos', [OrdemServicoController::class, 'index'])->name('ordemservicos.index');
    Route::get('/ordemservicos/create', [OrdemServicoController::class, 'create'])->name('ordemservicos.create');
    Route::post('/ordemservicos', [OrdemServicoController::class, 'store'])->name('ordemservicos.store');
    Route::get('/ordemservicos/{ordemServico}', [OrdemServicoController::class, 'show'])->name('ordemservicos.show');
    Route::get('/ordemservicos/{ordemServico}/edit', [OrdemServicoController::class, 'edit'])->name('ordemservicos.edit');
    Route::put('/ordemservicos/{ordemServico}', [OrdemServicoController::class, 'update'])->name('ordemservicos.update');
    Route::delete('/ordemservicos/{ordemServico}', [OrdemServicoController::class, 'destroy'])->name('ordemservicos.destroy');

    Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
    Route::get('/vendas/create', [VendaController::class, 'create'])->name('vendas.create');
    Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/vendas/{venda}', [VendaController::class, 'show'])->name('vendas.show');
    Route::get('/vendas/{venda}/edit', [VendaController::class, 'edit'])->name('vendas.edit');
    Route::put('/vendas/{venda}', [VendaController::class, 'update'])->name('vendas.update');
    Route::delete('/vendas/{venda}', [VendaController::class, 'destroy'])->name('vendas.destroy');

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/{produto}', [ProdutoController::class, 'show'])->name('produtos.show');
    Route::get('/produtos/{produto}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/{produto}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

    Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos.index');
    Route::get('/servicos/create', [ServicoController::class, 'create'])->name('servicos.create');
    Route::post('/servicos', [ServicoController::class, 'store'])->name('servicos.store');
    Route::get('/servicos/{servico}', [ServicoController::class, 'show'])->name('servicos.show');
    Route::get('/servicos/{servico}/edit', [ServicoController::class, 'edit'])->name('servicos.edit');
    Route::put('/servicos/{servico}', [ServicoController::class, 'update'])->name('servicos.update');
    Route::delete('/servicos/{servico}', [ServicoController::class, 'destroy'])->name('servicos.destroy');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    Route::get('/veiculos/create', [VeiculoController::class, 'create'])->name('veiculos.create');
    Route::post('/veiculos', [VeiculoController::class, 'store'])->name('veiculos.store');
    Route::get('/veiculos/{veiculo}/edit', [VeiculoController::class, 'edit'])->name('veiculos.edit');
    Route::put('/veiculos/{veiculo}', [VeiculoController::class, 'update'])->name('veiculos.update');
    Route::delete('/veiculos/{veiculo}', [VeiculoController::class, 'destroy'])->name('veiculos.destroy');
});



Route::get('/dashboard', function () {
    return redirect()->route('oficina.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

require __DIR__ . '/auth.php';
