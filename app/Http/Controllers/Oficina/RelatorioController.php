<?php

namespace App\Http\Controllers\Oficina;

use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Models\OrdemServico;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{

    public function index()
    {
        return view('oficina.index');
    }

    public function faturamento()
    {
        $faturamentoVendas = Venda::sum('valor_total');
        $faturamentoOS = OrdemServico::sum('valor_total');
        $faturamentoTotal = $faturamentoVendas + $faturamentoOS;
        $totalRegistros = Venda::count() + OrdemServico::count();

        return view('oficina.relatorio.faturamento', compact('faturamentoTotal', 'totalRegistros'));
    }


    public function topClientes()
    {
        $topClientes = OrdemServico::join('clientes', 'ordem_servicos.cliente_id', '=', 'clientes.id')
            ->select('clientes.nome', DB::raw('count(ordem_servicos.id) as total_os'))
            ->groupBy('clientes.nome')
            ->orderBy('total_os', 'desc')
            ->take(5)
            ->get();

        return view('oficina.relatorio.topclientes', compact('topClientes'));
    }

    public function topProdutos()
    {
        $topProdutos = OrdemServico::whereNotNull('produto_id')
            ->join('produtos', 'ordem_servicos.produto_id', '=', 'produtos.id')
            ->select('produtos.nome', DB::raw('sum(ordem_servicos.produto_quantidade) as total_usado'))
            ->groupBy('produtos.nome')
            ->orderBy('total_usado', 'desc')
            ->take(5)
            ->get();

        return view('oficina.relatorio.topprodutos', compact('topProdutos'));
    }


    public function topServicos()
    {
        $topServicos = OrdemServico::whereNotNull('servico_id')
            ->join('servicos', 'ordem_servicos.servico_id', '=', 'servicos.id')
            ->select('servicos.nome', DB::raw('count(ordem_servicos.id) as total_realizado'))
            ->groupBy('servicos.nome')
            ->orderBy('total_realizado', 'desc')
            ->take(5)
            ->get();

        return view('oficina.relatorio.topservicos', compact('topServicos'));
    }

    public function osPorStatus()
    {
        $osPorStatus = OrdemServico::select('status', DB::raw('count(id) as total'))
            ->groupBy('status')
            ->orderBy('total', 'desc')
            ->get();

        return view('oficina.relatorio.osstatus', compact('osPorStatus'));
    }
}
