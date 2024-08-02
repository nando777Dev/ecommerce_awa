
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
<header>
    <nav class="navbar navbar-default navbar-sticky bootsnav">
        <div class="container">
            <div class="attr-nav">
                <ul>
                    <li class="cart-toggler">
                        <a href="#.">
                            <i class="fa fa-shopping-cart">
                            </i>
                            <span class="badge">{{ $itemCount ?? '' }}
                       </span>
                        </a>
                    </li>
                    <li class="search">
                        <a href="#.">
                            <i class="fa fa-search">
                            </i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars">
                    </i>
                </button>
                <a class="navbar-brand" href="index.html">

                    {{-- <img src="{{$url_logo}}" alt="{{$url_logo}}" >--}}
                </a>
            </div>
            <!-- End Header Navigation -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="fadeIn" data-out="fadeOut">
                    <li class="dropdown active">
                        <a href="/">Home</a>
                    </li>
                    <li class="dropdown">
                        <a href="/produtos" class="dropdown-toggle" data-toggle="dropdown">Produtos</a>
                        <ul class="dropdown-menu">
                            <li><a href="/produtos/destaques">Destaques</a></li>
                            <li><a href="/produtos/novos">Novos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown megamenu-fw">
                        <a href="#." class="dropdown-toggle" data-toggle="dropdown">Paginas</a>
                        <ul class="dropdown-menu megamenu-content" role="menu">
                            <li>
                                <div class="row">
                                    <div class="col-menu col-md-3">
                                        <h5 class="title heading_border">Coleções</h5>
                                        <div class="content">
                                            <ul class="menu-col">
                                                @if(isset($collections))
                                                    @foreach ($collections as $key => $collection)
                                                        <li><a href="{{ route('products.collection', ['collection' => $key]) }}">{{ $collection }}</a></li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-menu col-md-3">
                                        <h5 class="title heading_border">Categorias</h5>
                                        <div class="content">
                                            <ul class="menu-col">
                                                @if(isset($categorias))
                                                    @foreach ($categorias as $categoria)
                                                        <li><a href="#">{{ $categoria['name'] }}</a></li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-menu col-md-3">
                                        <h5 class="title heading_border">Informações</h5>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="#">Políticas de envio</a></li>
                                                <li><a href="#">Minha conta</a></li>
                                                <li><a href="#">Meu carrinho</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-menu col-md-3">
                                        <div class="content">
                                            <img src="../../../images/mega-menu.png" alt="menu" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/sobre-nos">Sobre nós</a>
                    </li>
                    <li>
                        <a href="/contato">Contate-nos</a>
                    </li>
                </ul>
            </div>

            <!-- /.navbar-collapse -->
            <div class=" search-toggle">
                <div class="top-search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon">
                  <i class="fa fa-search">
                  </i>

                </span>
                    </div>
                </div>
            </div>


            <ul class="cart-list">
                <li class="total clearfix">
                    <div class="pull-right">
                        {{--                        <strong>Shipping--}}
                        {{--                        </strong>: $5.00--}}
                    </div>
                    <div class="pull-left">

                        <strong>Total
                            @if(isset($totalCart))
                        </strong>:R$ {{ number_format($totalCart, 2, ',', '.') }}
                        @else
                            <strong>
                                R$0,00
                            </strong>
                        @endif

                    </div>
                </li>
                <li class="cart-btn">
                    <a href="/cart/view" class="active">Ver carrinho
                    </a>
                    <a href="/checkout/create">CHECKOUT
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
