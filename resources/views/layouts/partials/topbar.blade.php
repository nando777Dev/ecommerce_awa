<div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="header-top-entry">

                </div>

            </div>
            <div class="col-sm-8">
                <ul class="top_link">
                    <li>
                        <a href="/minha-conta" class="uppercase">Minha conta
                        </a>
                    </li>
                        <!-- Link de Login para Usuários Não Autenticados -->
                    @if (!auth()->check())
                        <li>
                            <a href="/login" class="uppercase">Login</a>
                        </li>
                    @else
                        <!-- Se o usuário ESTIVER autenticado -->
                        <li>
                            <a href="/checkout/create" class="uppercase">checkout</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="uppercase"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sair
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>
