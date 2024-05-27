@extends('layouts.app')

@section('title', 'Detalhes do produto')

@section('content')

    <section id="cart" class="padding_bottom">
        <div class="container">
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
                            <a class="icons" href="#">
                                <i class="fa fa-heart-o"></i>
                            </a>
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

                            {{--<div id="tab2" class="tab_content">
                                <ol class="commentlist">
                                    <li>
                                        <div class="avator clearfix"><img src="../../../images/testinomial1.png" class="img-responsive border-radius" alt="author">
                                        </div>
                                        <div class="comment-content"> <span class="stars"><img alt="star rating" src="../../../images/star.png"></span> <strong>Cobus Bester</strong> -
                                            <time datetime="2016-04-07T11:58:43+00:00">April 7, 2016</time>
                                            <p>This album proves why The Woo are the best band ever. Best music ever!</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="avator clearfix"><img src="../../../images/testinomial1.png" class="img-responsive border-radius" alt="author">
                                        </div>
                                        <div class="comment-content"> <span class="stars"><img alt="star rating" src="../../../images/star.png"></span> <strong>Cobus Bester</strong> -
                                            <time datetime="2016-04-07T11:58:43+00:00">April 7, 2016</time>
                                            <p>This album proves why The Woo are the best band ever. Best music ever!</p>
                                        </div>
                                    </li>
                                </ol>

                                <form class="review-form margintop15">
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label class="control-label">Your Review</label>
                                            <textarea class="form-control" rows="3" placeholder="Your Review"></textarea>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="inputPassword" class="control-label">Name</label>
                                            <input type="text" class="form-control" placeholder="Name">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="inputPassword" class="control-label">Password</label>
                                            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn-light border-radius" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="tab3" class="tab_content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-responsive table-striped">
                                            <tbody>
                                            <tr>
                                                <td>Part Number</td>
                                                <td>60-MCTE</td>
                                            </tr>
                                            <tr>
                                                <td>Item Weight</td>
                                                <td>54 pounds</td>
                                            </tr>
                                            <tr>
                                                <td>Product Dimensions</td>
                                                <td>92.8 inches</td>
                                            </tr>
                                            <tr>
                                                <td>Item model number</td>
                                                <td>60-MCTE</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-responsive table-striped">
                                            <tbody>
                                            <tr>
                                                <td>Item Package Quantity</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>Number of Handles</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>Batteries Required?</td>
                                                <td>NO</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="feature_product" class="bottom_half">
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
    </section>
@endsection

@section('javascript')

    <script type="text/javascript">

    </script>

@endsection
