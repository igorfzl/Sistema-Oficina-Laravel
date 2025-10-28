<?php

use App\Http\Controllers\Oficina\OrdemServicoController;
use App\Http\Controllers\Oficina\CategoriaController;
use App\Http\Controllers\Oficina\ServicoController;
use App\Http\Controllers\Oficina\ClienteController;
use App\Http\Controllers\Oficina\ProdutoController;
use App\Http\Controllers\Oficina\VeiculoController;
use App\Http\Controllers\Oficina\VendaController;
use App\Http\Controllers\ProfileController;
use App\Models\OrdemServico;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// --- CRUD de ordemservicos ---
Route::get('/oficina/ordemservicos', [OrdemServicoController::class, 'index'])->name('ordemservicos.index');
Route::get('/oficina/ordemservicos/create', [OrdemServicoController::class, 'create'])->name('ordemservicos.create');
Route::post('/oficina/ordemservicos', [OrdemServicoController::class, 'store'])->name('ordemservicos.store');
Route::get('/oficina/ordemservicos/{ordemServico}', [OrdemServicoController::class, 'show'])->name('ordemservicos.show');
Route::get('/oficina/ordemservicos/{ordemServico}/edit', [OrdemServicoController::class, 'edit'])->name('ordemservicos.edit');
Route::put('/oficina/ordemservicos/{ordemServico}', [OrdemServicoController::class, 'update'])->name('ordemservicos.update');
Route::delete('/oficina/ordemservicos/{ordemServico}', [OrdemServicoController::class, 'destroy'])->name('ordemservicos.destroy');



// --- CRUD de Vendas ---
Route::get('/oficina/vendas', [VendaController::class, 'index'])->name('vendas.index');
Route::get('/oficina/vendas/create', [VendaController::class, 'create'])->name('vendas.create');
Route::post('/oficina/vendas', [VendaController::class, 'store'])->name('vendas.store');
Route::get('/oficina/vendas/{venda}', [VendaController::class, 'show'])->name('vendas.show');
Route::get('/oficina/vendas/{venda}/edit', [VendaController::class, 'edit'])->name('vendas.edit');
Route::put('/oficina/vendas/{venda}', [VendaController::class, 'update'])->name('vendas.update');
Route::delete('/oficina/vendas/{venda}', [VendaController::class, 'destroy'])->name('vendas.destroy');


// --- CRUD de Categorias ---
Route::get('/oficina/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/oficina/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/oficina/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/oficina/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('/oficina/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/oficina/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/oficina/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');


// --- CRUD de Produtos ---
Route::get('/oficina/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/oficina/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/oficina/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
Route::get('/oficina/produtos/{produto}', [ProdutoController::class, 'show'])->name('produtos.show');
Route::get('/oficina/produtos/{produto}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');
Route::put('/oficina/produtos/{produto}', [ProdutoController::class, 'update'])->name('produtos.update');
Route::delete('/oficina/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');


// --- CRUD de Serviços ---
Route::get('/oficina/servicos', [ServicoController::class, 'index'])->name('servicos.index');
Route::get('/oficina/servicos/create', [ServicoController::class, 'create'])->name('servicos.create');
Route::post('/oficina/servicos', [ServicoController::class, 'store'])->name('servicos.store');
Route::get('/oficina/servicos/{servico}', [ServicoController::class, 'show'])->name('servicos.show');
Route::get('/oficina/servicos/{servico}/edit', [ServicoController::class, 'edit'])->name('servicos.edit');
Route::put('/oficina/servicos/{servico}', [ServicoController::class, 'update'])->name('servicos.update');
Route::delete('/oficina/servicos/{servico}', [ServicoController::class, 'destroy'])->name('servicos.destroy');


// --- CRUD de Clientes ---
Route::get('/oficina', [ClienteController::class, 'home'])->name('oficina.index');
Route::get('/oficina/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/oficina/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/oficina/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/oficina/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
Route::get('/oficina/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/oficina/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/oficina/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');


// --- CRUD de Veículos ---
Route::get('/oficina/veiculos/create', [VeiculoController::class, 'create'])->name('veiculos.create');
Route::post('/oficina/veiculos', [VeiculoController::class, 'store'])->name('veiculos.store');
Route::get('/oficina/veiculos/{veiculo}/edit', [VeiculoController::class, 'edit'])->name('veiculos.edit');
Route::put('/oficina/veiculos/{veiculo}', [VeiculoController::class, 'update'])->name('veiculos.update');
Route::delete('/oficina/veiculos/{veiculo}', [VeiculoController::class, 'destroy'])->name('veiculos.destroy');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
