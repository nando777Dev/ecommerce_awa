@extends('layouts.app')

@section('title', 'Destaques')

@section('content')

    <style>
        .size_img {
            width: 277px;
            height: 240px;
        }
    </style>
    <section class="page_menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="hidden">hidden</h3>
                    <ul class="breadcrumb">
                        <li><a href="/">Home</a>
                        </li>
                        <li class="active">Novos</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="grid padding">
        <h3 class="hidden">hidden</h3>
        <div class="container">
            <div class="col-md-3 col-sm-3">
                <aside class="sidebar">
                    <div class="widget content_space">
                        <h4 class="heading uppercase bottom30">Categorias</h4>
                        <div class="accordion-container">
                            <div class="set">
                                <a href="{{ route('products.index') }}">Todas </a></li>
                            </div>
                            @foreach ($categorias as $categoria)
                                <div class="set">
                                    <a href="{{ route('products.index', ['categoria' => $categoria['id']]) }}" class="uppercase">{{ $categoria['name'] }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="widget content_space">
                        <h4 class="heading uppercase bottom30">Comprar por</h4>
                        <h5 class="uppercase marginbottom15">Marca / Fabricante</h5>

                        <ul class="category">
                            <li><a href="{{ route('products.index') }}">Todas </a></li>
                            @foreach ($marcas as $marca)
                                <li><a href="{{ route('products.index', ['marca' => $marca['id']]) }}">{{ $marca['name'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget content_space">
                        <h5 class="uppercase marginbottom15">Preço</h5>
                        <form action="{{ route('products.index') }}" method="GET">
                            <div class="range">
                                <div id="slider-3"></div>
                                <p>
                                    <input type="text" name="price" id="price" style="border:0; color:#333333; font-weight:bold; font-size:10px;">
                                </p>
                                <button type="submit">Procurar</button>
                            </div>
                        </form>
                    </div>
                </aside>
            </div>
            <div class="col-md-9 col-sm-8">
                <div class="shop-grid-controls">
                    <div class="view-button grid active bottom30">
                        <i class="fa fa-th-large"></i>
                    </div>
                    <div class="view-button list bottom30">
                        <i class="fa fa-align-justify"></i>
                    </div>
                    <div class="entry bottom30">
                        <form class="grid-form" method="GET" action="{{ url()->current() }}">
                            <div class="form-group">
                                <div class="select form-control">
                                    <select name="sort" id="sorting" onchange="this.form.submit()">
                                        <option value="" selected>Classificar</option>
                                        <option value="price_desc">Maior para menor preço</option>
                                        <option value="price_asc">Menor para maior preço</option>
                                        <option value="name_asc">Ordem alfabética</option> <!-- Nova opção de ordenação -->
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if ($products->isEmpty())
                    <div class="alert alert-info">
                        Nenhum resultado encontrado para a pesquisa.
                    </div>
                @else
                    <div class="row shop-grid grid-view">
                        @foreach ($products as $product)
                            <div class="col-md-4 col-sm-6">
                                <div class="product_wrap heading_space">
                                    <div class="image">
                                        @if ($product->novo)
                                            <div class="tag">
                                                <div class="tag-btn">
                                                    <span class="uppercase text-center">Novo</span>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($product->destaque)
                                            <div class="tag">
                                                <div class="tag-btn">
                                                    <span class="uppercase text-center">Destaque</span>
                                                </div>
                                            </div>
                                        @endif
                                        <a class="fancybox size_img" href="{{ $url_img . $product->image }}" >
                                            <img src="{{ $url_img . $product->image }}" alt="{{ $product->name_produto }}" class="img-responsive size_img" >
                                        </a>
                                    </div>
                                    <div class="product_desc">
                                        <a href="/produtos/show/ {{$product->id_produto}}" style="font-size: 12px">{{ $product->name_produto }}</a><br>
                                        <div class="list_content margintop40">
                                            <p class="bottom30">{{ $product->description }}</p>
                                            <ul class="review_list bottomtop30">
                                                {{-- <li><img alt="star" src="{{ asset('images/star.png') }}"></li>
                                                 <li><a href="#.">10 review(s)</a></li>--}}
                                            </ul>
                                            <p><u>Especificações </u> <small>em centimentos</small></p>
                                            <p>Altura - {{$product->altura}} </p>
                                            <p>Comprimento -  {{$product->comprimento}}</p>
                                            <p>Largura - {{ $product->largura}}</p>
                                            <p>Peso - {{ $product->peso ?? '0.00'}} </p>
                                            <br>
                                            <h4 class="price bottom30">

                                                &nbsp;<span class="discount"><i></i>R${{number_format($product->price, 2, ',', '.')  }}</span>
                                            </h4>
                                            @if ($product->stock > 0)
                                                <form action="{{ route('cart.add') }}" method="POST">
                                                    <div class="cart-buttons">
                                                        @csrf
                                                        <input type="hidden" name="id_produto" value="{{ $product->id_produto }}">
                                                        <input type="hidden" name="nome_produto" value="{{ $product->name_produto }}">
                                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                                        <input type="hidden" name="img" value="{{ $product->image }}">
                                                        <input type="hidden" name="quantidade" value="1">
                                                        <button class="uppercase border-radius btn-dark">
                                                            <i class="fa fa-shopping-basket"></i> &nbsp; Adicionar ao carrinho
                                                        </button>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="out-of-stock-message" style="color: red; font-weight: bold;">
                                                    Produto sem estoque ou fabricado mediante a demanda!. Entre contato para orçamento e prazo de entrega!
                                                </div>
                                            @endif
                                        </div>
                                        <span class="price"><i></i>R${{number_format($product->price, 2, ',', '.')  }}</span>
                                        <a class="fancybox" href="{{ $url_img . $product->image }}" data-fancybox-group="gallery" style="width: 277px">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            {{ $products->links() }}
                        </div>
                        <div class="col-md-6 col-sm-6 text-right">
                            <h5 class="result uppercase">
                                Mostrando {{ $products->firstItem() }}-{{ $products->lastItem() }} de {{ $products->total() }} resultados
                            </h5>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>

@endsection

@section('javascript')
    <script type="text/javascript">

        $(document).ready(function() {
            // Check if there are no items in the cart and show the popup
            if ($('#cart').length) {
                $('#promotion-popup').fadeIn();
            }

            // Close the popup when the close button is clicked
            $('.close-btn').on('click', function() {
                $('#promotion-popup').fadeOut();
            });
        });

    </script>

@endsection
