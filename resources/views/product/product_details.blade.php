@extends('layouts.app')

@section('title', 'Detalhes do produto')

@section('content')

    <section id="cart" class="padding_bottom">
        <div class="container">
            <div class="row">
                <ul class="breadcrumb">
                    <li><a href="/produtos">Produtos</a></li>
                    <li class="active">Detahes</li>
                </ul>
            </div>
            <div class="row">



                <div class="col-sm-6">
                    <div id="slider_product" class="cbp margintop40">
                        @foreach ($productDetails[0]['images'] as $image)
                            <div class="cbp-item">
                                <div class="cbp-caption">
                                    <div class="cbp-caption-defaultWrap">
                                        <img src="{{ $url. $image }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="js-pagination-slider">
                        @foreach ($productDetails[0]['images'] as $image)
                            <div class="cbp-pagination-item cbp-pagination-active">
                                <img src="{{ $url. $image }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="detail_pro margintop40">
                        <h4 class="bottom30">{{ $productDetails[0]['nome_produto'] }}</h4>
                        <p class="bottom30">{!! $productDetails[0]['description'] !!}</p>
                        <p><u>Especificações</u></p>
                        <p>Peso: {{ $productDetails[0]['peso'] ?? '' }}</p>
                        <p>Altura: {{ $productDetails[0]['altura'] }}</p>
                        <p>Largura: {{ $productDetails[0]['largura'] }}</p>
                        <p>Comprimento: {{ $productDetails[0]['comprimento'] }}</p>
                        <ul class="review_list marginbottom15">
                            <li><img src="{{ asset('images/star.png') }}" alt="star"></li>
                        </ul>

                        <h2 class="price marginbottom15"><i>R$</i> {{ number_format($productDetails[0]['price'], 2, ',', '.') }}</h2>


                        @foreach ($variations as $variationName => $variationOptions)
                            <div class="form-group">
                                <label for="{{ Str::slug($variationName) }}">
                                    {{ $variationName }} *
                                </label>
                                <label class="select form-control">
                                    <select name="{{ Str::slug($variationName) }}" id="{{ Str::slug($variationName) }}">
                                        <option value="" selected>- Por favor selecione -</option>
                                        @foreach ($variationOptions as $variationId => $variation)
                                            <option value="{{ $variationId }}">{{ $variation }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        @endforeach



                        <div class="cart-buttons">
                            @if ($productDetails[0]['stock'] > 0)
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_produto" value="{{ $productDetails[0]['id_produto']}} ">
                                <input type="hidden" name="nome_produto" value="{{ $productDetails[0]['nome_produto']}} ">
                                <input type="hidden" name="price" value="{{ $productDetails[0]['price']}} ">
                                <input type="hidden" name="img" value="{{ $productDetails[0]['images'][0]}} ">
                                <input type="hidden" name="quantidade" value="1">

                                <button class="uppercase border-radius btn-dark">
                                    <i class="fa fa-shopping-basket"></i> &nbsp; Adicione ao carrinho
                                </button>
                            </form>
                            @else
                                <div class="out-of-stock-message" style="color: red; font-weight: bold;">
                                    Produto sem estoque ou fabricado mediante a demanda!. Entre contato para orçamento e prazo de entrega!
                                </div>
                            @endif
                           {{--  <a class="icons" href="#">
                                <i class="fa fa-heart-o"></i>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="bottom_half">
        <div class="container">
            <div class="row">
                <div class="clearfix col-md-12">
                    <div class="shop_tab">
                        <ul class="tabs">
                            <li class="active" rel="tab1">
                                <h4 class="heading uppercase">Descrição</h4>
                            </li>
                           {{-- <li rel="tab2">
                                <h4 class="heading uppercase">Avaliações de Clientes</h4>
                            </li>
                            <li rel="tab3">
                                <h4 class="heading uppercase">Tags do Produto</h4>
                            </li>--}}
                        </ul>
                        <div class="tab_container">
                            <div id="tab1" class="tab_content">
                                <p class="bottom30">{!! $productDetails[0]['description'] !!}</p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- <section id="feature_product" class="bottom_half">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="heading uppercase bottom30">upsell products</h4>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product_wrap bottom_half">
                        <div class="tag-btn"><span class="uppercase text-center">New</span>
                        </div>
                        <div class="image">
                            <a class="fancybox" href="../../../images/product1.jpg"><img src="../../../images/product1.jpg" alt="Product" class="img-responsive">
                            </a>
                        </div>
                        <div class="product_desc">
                            <p class="title">Sacrificial Chair Design </p>
                            <span class="price"><i class="fa fa-gbp"></i>170.00</span>
                            <a class="fancybox" href="../../../images/product1.jpg" data-fancybox-group="gallery"><i class="fa fa-shopping-bag open"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product_wrap bottom_half">
                        <div class="image">
                            <a class="fancybox" href="../../../images/product2.jpg"><img src="../../../images/product2.jpg" alt="Product" class="img-responsive">
                            </a>
                        </div>
                        <div class="product_desc">
                            <p class="title">Sacrificial Chair Design </p>
                            <span class="price"><i class="fa fa-gbp"></i>170.00</span>
                            <a class="fancybox" href="../../../images/product2.jpg" data-fancybox-group="gallery"><i class="fa fa-shopping-bag open"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product_wrap bottom_half">
                        <div class="tag-btn"><span class="uppercase text-center">New</span>
                        </div>
                        <div class="image">
                            <a class="fancybox" href="../../../images/product8.jpg"><img src="../../../images/product8.jpg" alt="Product" class="img-responsive">
                            </a>
                        </div>
                        <div class="product_desc">
                            <p class="title">Sacrificial Chair Design </p>
                            <span class="price"><i class="fa fa-gbp"></i>170.00</span>
                            <a class="fancybox" href="../../../images/product8.jpg" data-fancybox-group="gallery"><i class="fa fa-shopping-bag open"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="product_wrap bottom_half">
                        <div class="image">
                            <a class="fancybox" href="../../../images/product4.jpg"><img src="../../../images/product4.jpg" alt="Product" class="img-responsive">
                            </a>
                        </div>
                        <div class="product_desc">
                            <p class="title">Sacrificial Chair Design </p>
                            <span class="price"><i class="fa fa-gbp"></i>170.00</span>
                            <a class="fancybox" href="../../../images/product4.jpg" data-fancybox-group="gallery"><i class="fa fa-shopping-bag open"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@section('javascript')

    <script type="text/javascript">

    </script>

@endsection
