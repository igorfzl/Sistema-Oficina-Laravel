<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar-custom-gradient {
            background-image: linear-gradient(90deg, rgba(35, 33, 191, 1) 0%, rgba(28, 7, 7, 1) 50%, rgba(173, 0, 0, 1) 100%);
        }

        .navbar-custom-gradient .nav-link,
        .navbar-custom-gradient .navbar-brand {
            color: #ffffff !important;
        }

        .navbar-custom-gradient .nav-link.active {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom-gradient" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('oficina.index')}}">AutoGest <i>v1.0</i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vendas.index') }}">Realizar Venda <i>(PDV)</i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Realizar Ordem de Serviço</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('servicos.index') }}">Gerenciar Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clientes.index') }}">Gerenciar Clientes</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gerenciar Produtos / Categorias
                        </a>
                        <ul class="dropdown-menu w-100">
                            <li><a class="dropdown-item" href="{{ route('produtos.index') }}">Gerenciar Produtos</a></li>
                            <li><a class="dropdown-item" href="{{ route('categorias.index') }}">Gerenciar Categorias</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Relatórios
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Vendas por período</a></li>
                            <li><a class="dropdown-item" href="#">Serviços realizados</a></li>
                            <li><a class="dropdown-item" href="#">Estoque de peças</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
