<header class="py-3 mb-10">
    <div class="container col-md-7">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="../../images/logo.png" width="130"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @if (Auth::check())
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ \Request::route()->getName() === 'posts' ? 'active' : '' }}" href="{{ route('posts') }}">Postagens</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ \Request::route()->getName() === 'categorias' ? 'active' : '' }}" href="{{ route('categorias') }}">Categorias</a>
                        </li>
                        <li><a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Sair</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form></li>
                    </ul>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <label class="control-label mt-4">
                        <h5>{{ "Olá " . Auth::user()->name . "!" }}</h5>
                    </label>
                </div>
                @else
                <div class="form-group mt-3">
                    <a href="{{ route('login') }}" class="btn btn-link">Entrar</a>
                    <a href="{{ route('register') }}" class="btn btn-link">Cadastrar</a>
                </div>
                @endif
            </div>
        </nav>
    </div>
</header>